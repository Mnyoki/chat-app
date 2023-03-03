if (isset($_POST['username'])  && isset($_POST['password'])) {
    // do user authentication as per your requirements
    $username = $_POST['username']
    $pass = $_POST['password']
    // based on successful authentication
    //echo  " helo $username. your password is $pass"
    echo json_encode(array('success' => 1));
} else {
    echo json_encode(array('success' => 0));
}
