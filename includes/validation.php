<?php
function validate($data, $rules)
{
    global $conn;
    $errors = [];
    foreach ($rules as $field => $rule) {
        $rules = explode('|', $rule);
        foreach ($rules as $rule) {
            $rule_data = explode(':', $rule);
            $rule = $rule_data[0];
            $rule_value = $rule_data[1] ?? null;
            switch ($rule) {
                case 'required':
                    $data[$field] = trim($data[$field]);
                    if (empty($data[$field]) && empty($errors[$field])) {
                        $errors[$field] = ucfirst($field) . ' is required';
                    }
                    break;
                case 'email':
                    if (!filter_var($data[$field], FILTER_VALIDATE_EMAIL) && empty($errors[$field])) {
                        $errors[$field] = 'Invalid email format';
                    }
                    break;
                case 'min':
                    if (strlen($data[$field]) < $rule_value && empty($errors[$field])) {
                        $errors[$field] = ucfirst($field) . ' min is ' . $rule_value;
                    }
                    break;
                case 'max':
                    if (strlen($data[$field]) > $rule_value && empty($errors[$field])) {
                        $errors[$field] = ucfirst($field) . ' max is ' . $rule_value;
                    }
                    break;
                case 'alpha_numeric':
                    if (!preg_match('/^[a-zA-Z0-9]+$/', $data[$field]) && empty($errors[$field])) {
                        $errors[$field] = ucfirst($field) . ' must be alpha numeric';
                    }
                    break;
                case 'numeric':
                    if (!preg_match('/^[0-9]+$/', $data[$field]) && empty($errors[$field])) {
                        $errors[$field] = ucfirst($field) . ' must be numeric';
                    }
                    break;
                case "unique": // unique:users,email
                    $table = explode(',', $rule_value)[0];
                    $col = explode(',', $rule_value)[1];
                    $sql = "SELECT * FROM $table WHERE $col = '$data[$field]'";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0 && empty($errors[$field])) {
                        $errors[$field] = ucfirst($field) . ' already exists';
                    }
                    break;
                case "exists": // unique:users,email
                    $table = explode(',', $rule_value)[0];
                    $col = explode(',', $rule_value)[1];
                    $sql = "SELECT * FROM $table WHERE $col = '$data[$field]'";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) == 0 && empty($errors[$field])) {
                        $errors[$field] = ucfirst($field) . ' does not exist';
                    }
                    break;
            }
        }
    }
    return $errors;
}
