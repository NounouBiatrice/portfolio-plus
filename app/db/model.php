<?php 

abstract class Model {
  
  protected 
    $conn, 
    $bindArray = array(), 
    $pk, 
    $table;
  protected static $bindings = array();
  
  public function __construct ($id = 0, $createBind = true) {
    $this->conn = Connection::getConnection();
    if ($createBind) $this->createBindArray();
    if ($id > 0) {
      $primary = $this->pk;
      $this->$primary = $id;
      $this->load();
    }
  }
  
  //must have id controls
  abstract public function getId();
  abstract protected function setId($id);
  
  // General Accessors
  public function get ($field) {
    return $this->$field;
  }

  public function set ($field, $val) {
    if ($field == $this->pk) // don't allow setting of ID from outside
      throw new Exception(
        'Invalid request to set ID on '.$field.' in Model ('.$this->table.')'
      );
    if ($field == "password") 
      $val = crypt($val, AUTH_KEY);
    $this->$field = $val;
  }
  
  public function add ($col, $obj) {
    array_push($this->$col, $obj);
  }
  
  // CRUD
  protected function load ($where = array()) {
    $fields = '';
    $results = array();
    $resultParams = array();
    $whereParams = array();
    $keys = array_keys($this->bindArray);
    for ($i = 0; $i < count($keys); $i++) {
      $fields .= $keys[$i];
      if ($i + 1 < count($keys)) {
        $fields .= ',';
      }
      $fields .= ' ';
      $resultParams[] = &$results[$keys[$i]];
    }
    $whereClause = $this->buildWhereClause($where, '', $whereParams);
    $sql = 'SELECT ' . $fields . 'FROM ' . $this->table . $whereClause;
    $stmt = $this->conn->prepare($sql);
    if ($stmt) {
      call_user_func_array(array($stmt, 'bind_param'), self::refValues($whereParams));
      $stmt->execute();
      call_user_func_array(array($stmt, 'bind_result'), $resultParams);
      $stmt->fetch();
      foreach ($keys as $key) {
        $this->$key = $results[$key];
      }
      $stmt->close();
    }
  }

   public function save () {
    if (!count($this->bindArray)) $this->createBindArray();
    if ($this->getId() > 0) {
      $this->update();
    } else $this->insert();
  }
  
  protected function insert ($insertFields = array()) {
    $fields = '';
    $params = '';
    $bindings = '';
    $bindParams = array();
    if (count($insertFields)) $keys = $insertFields;
    else $keys = array_keys($this->bindArray);
    for ($i = 0; $i < count($keys); $i++) {
      if ($keys[$i] != $this->pk) {
        $fields .= $keys[$i];
        $bindings .= $this->bindArray[$keys[$i]];
        $params .= '? ';
        if ($i + 1 < count($keys)) {
          $fields .= ',';
          $params .= ',';
        }
        $fields .= ' ';
        $bindParams[] = &$this->$keys[$i];
      }
    }
    array_unshift($bindParams, $bindings);
    $sql = 'INSERT INTO ' . $this->table . ' (' . $fields . ') ';
    $sql .= 'VALUES (' . $params . ')';
    $stmt = $this->conn->prepare($sql);
    if ($stmt) {
      call_user_func_array(array($stmt, 'bind_param'), $bindParams);
      $stmt->execute();
      $stmt->close();
      $this->setId($this->conn->insert_id);
    }
  }

  protected function update ($where = array(), $updateFields = array()) {
    $bindings = '';
    $bindParams = array();
    $wp = array(); // temp var to deal with pass by reference issue in call_user_func_arrray
    $sql = 'UPDATE ' . $this->table . ' SET ';
    if (count($updateFields)) $keys = $updateFields;
    else $keys = array_keys($this->bindArray);
    for ($i = 0; $i < count($keys); $i++) {
      if ($keys[$i] != $this->pk) {
        $sql .= $keys[$i] . ' = ?';
        $bindings .= $this->bindArray[$keys[$i]];
        if ($i + 1 < count($keys)) {
          $sql .= ',';
        }
        $bindParams[] = &$this->$keys[$i];
      }
    }
    $whereClause = $this->buildWhereClause($where, $bindings, $bindParams);
    foreach($bindParams as $k => $v) $wp[$k] = &$bindParams[$k];
    $sql .= $whereClause;
    $stmt = $this->conn->prepare($sql);
    if ($stmt) {
      call_user_func_array(array($stmt, 'bind_param'), $wp);
      $stmt->execute();
      $stmt->close();
    }
  }

  public function delete () {
    $primaryKey = $this->pk;
    $sql = 'DELETE FROM ' . $this->table . ' WHERE ' . $primaryKey . ' = ?';
    $stmt = $this->conn->prepare($sql);
    if ($stmt) {
      $stmt->bind_param('i', $this->$primaryKey);
      $stmt->execute();
      $stmt->close();
    }
  }

  // Utils
  protected function buildWhereClause ($where, $bindings, &$bindParams) {
    $whereClause = ' WHERE ';
    if (count($where)) {
      for($i = 0; $i < count($where); $i++) {
        if ($i > 0) $whereClause .= ' ' . $where[$i]['conjunction'] . ' ';
        $whereClause .= $where[$i]['field'] . ' ' . $where[$i]['operator'] . ' ?';
        $bindings .= $this->getBindType($where[$i]['value']);
        $bindParams[] = $where[$i]['value'];
      }
    } else {
      $whereClause .= $this->pk . ' = ?';
      $bindings .= 'i';
      $primaryKey = $this->pk;
      $bindParams[] = $this->$primaryKey;
    }
    array_unshift($bindParams, $bindings);
    return $whereClause;
  }
  
  protected function createBindArray () {
    try {
      if (!array_key_exists($this->table, self::$bindings)) {
        $sql = 'SHOW COLUMNS FROM ' . $this->table;
        $result = $this->conn->query($sql);
        if ($result) {
          $objBindings = array();
          $primary = null;
          while ($row = $result->fetch_assoc()) {
            if ($row['Key'] == 'PRI' && !$primary) $primary= $row['Field'];
            if (strpos($row['Type'], 'text') !== false || strpos($row['Type'], 'varchar') !== false )
              $paramType = 's';
            elseif (strpos($row['Type'], 'int') !== false )
              $paramType = 'i';
            elseif (strpos($row['Type'], 'date') !== false )
              $paramType = 's';
            $objBindings[$row['Field']] = $paramType;
          }
          self::$bindings[$this->table]['bindArray'] = $objBindings;
          self::$bindings[$this->table]['pk'] = $primary;
          #echo '<pre>' . print_r(self::$bindings) . '</pre><br />';
        } else var_dump($this->conn->error);
      } 
      $this->bindArray =& self::$bindings[$this->table]['bindArray'];
      $this->pk =& self::$bindings[$this->table]['pk'];
    } catch (Exception $ex) {
      die($ex->message); // replace with global error handler when built
    }
  }
  
  protected function getBindType ($param) {
    if (is_int($param)) return 'i';
    else if (is_string($param)) return 's';
    else throw new Exception('Invalid type applied to bind variable in database query');
  }
   
  public function getNowDateTime () {
    return date('Y-m-d H:i:s');
  }

  protected static function refValues($arr) {
    if (strnatcmp(phpversion(),'5.3') >= 0) //Reference is required for PHP 5.3+
    {
      $refs = array();
      foreach($arr as $key => $value)
        $refs[$key] = &$arr[$key];
      return $refs;
    }
    return $arr;
  }
  
}
