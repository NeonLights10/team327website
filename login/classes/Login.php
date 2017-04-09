<?php
    require '../../vendor/autoload.php';
    (require_once("dbcreds.php")) or die("Unable to access database ERR:1");
/** 
 * Class login
 * handles the user's login and logout process
 */
class Login
{
    /**
     * @var object The database connection
     */
    private $db_connection = null;
    /**
     * @var array Collection of error messages
     */
    public $errors = array();
    /**
     * @var array Collection of success / neutral messages
     */
    public $messages = array();

    public $successful=false;
    /**
     * the function "__construct()" automatically starts whenever an object of this class is created,
     * you know, when you do "$login = new Login();"
     */
    public function __construct()
    {
        
        session_start();
        // check the possible login actions:
        // if user tried to log out (happen when user clicks logout button)
        if (isset($_GET["logout"])) {
            $this->doLogout();
        }
        else
        {
            $this->dologinWithPostData();
        }
    }

    /**
     * log in with post data
     */
    private function dologinWithPostData()
    {
        // check login form contents
        if (empty($_POST['user_name'])) {
            $this->errors[] = "Username field was empty.";
        } elseif (empty($_POST['user_password'])) {
            $this->errors[] = "Password field was empty.";
        } elseif (!empty($_POST['user_name']) && !empty($_POST['user_password'])) {

            // create a database connection, using the constants from config/db.php (which we loaded in index.php)
            $this->db_connection = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

            // change character set to utf8 and check it
            if (!$this->db_connection->set_charset("utf8")) {
                $this->errors[] = $this->db_connection->error;
            }

            // if no connection errors (= working database connection)
            if (!$this->db_connection->connect_errno) {

                // escape the POST stuff
                $user_name = $this->db_connection->real_escape_string($_POST['user_name']);

                // database query, getting all the info of the selected user (allows login via email address in the
                // username field)
				//Prepared statement to prevent other types of injection
                $sql = "SELECT user_name, user_email, user_password_hash, user_team, user_first_name, user_last_name 
                        FROM users
                        WHERE user_name = '" . $user_name . "' OR user_email = '" . $user_name . "';";
                $result_of_login_check = $this->db_connection->query($sql);

                // if this user exists
                if ($result_of_login_check->num_rows === 1) {

                    // get result row (as an object)
                    $result_row = $result_of_login_check->fetch_object();

                    // using PHP 5.5's password_verify() function to check if the provided password fits
                    // the hash of that user's password
                    if (password_verify($_POST['user_password'], $result_row->user_password_hash)) {

                        // write user data into PHP SESSION (a file on the server) (allows persistance across pages)
                        $_SESSION['user_name'] = $result_row->user_name;
                        $_SESSION['user_email'] = $result_row->user_email;
						$_SESSION['user_team'] = $result_row->user_team;
                        $_SESSION['first_name'] = $result_row->user_first_name;
                        $_SESSION['last_name'] = $result_row->user_last_name;
                        $_SESSION['user_login_status'] = 1;
                        $_SESSION['user_id'] = $result_row->user_id;
                        //$_SESSION['user_type'] = $result_row->user_type;
                        $team = $_SESSION['user_team'];

                        $update_collection = (new MongoDB\Client("mongodb://" . MDB_USER . ":" . MDB_PASS . "@" . DB_HOST . ":27017"))->teams->$team;
						//Check for documents in collection, if there are none then create collection
						//Create connection to the team collection to prepare for copying database
						$copy_collection = (new MongoDB\Client("mongodb://" . MDB_USER . ":" . MDB_PASS . "@" . DB_HOST . ":27017"))->teams->teams;
						//Get number of teams
						$cursor = $copy_collection->count();
						echo $cursor;
						$cursor2 = $update_collection->count();
						if($cursor > $cursor2 || $cursor2 > $cursor) {
							$this->updateCollection($cursor, $cursor2, $copy_collection, $update_collection);
						}
                        $this->successful=true;
                    } else {
                        $this->errors[] = "Incorrect username or password";
                    }
                } else {
                    $this->errors[] = "User does not exist";
                }
            } else {
                $this->errors[] = "Unable to access database ERR:2";
            }
        }
    }

    public function updateCollection(int $cursor, int $cursor2, MongoDB\Collection $copy_collection, MongoDB\Collection $update_collection)
    {
        /* Get each document from the teams collection using UUID index
         * Retrive document values and prepare them for insertion
         * Insert new document into the new team collection */
        for($i = 0; $i < $cursor; $i++) {
            $current = $copy_collection->findOne(['uuid' => ($i + 1)]);
            $uuid = $current['uuid'];
            $team_name = $current['team_name'];
            $team_division = $current['team_division'];
            $team_number = $current['team_number'];
            $team_school = $current['team_school'];
            $team_city = $current['team_city'];
            $team_state = $current['team_state'];
            $result = $update_collection->updateOne([
                'team_number' => $team_number],
                ['$set' => 
                ['uuid' => $uuid,
                'team_number' => $team_number,
                'team_name' => $team_name,
                'team_division' => $team_division,
                'team_school' => $team_school,
                'team_city' => $team_city,
                'team_state' => $team_state]],
				['upsert' => true]								   
			);
            // $users->insert($userinfo, array('safe' => true)); Use if you want synchronous addition
        }
	   	printf("Modified %d document(s)\n", $result->getModifiedCount());
   	   	printf("Upserted %d document(s)\n", $result->getUpsertedCount());
            echo "<br>";

		$deleted = false;
        for($i = 0; $i < $cursor2; $i++) {
            $current = $copy_collection->findOne(['uuid' => ($i + 1)]);
            if ($current == null) {
				$deleted = true;
                $delete_result = $update_collection->deleteOne(['uuid' => ($i + 1)]);
            }
        }
		if ($deleted == true) {
			printf("Deleted %d document(s)\n", $delete_result->getDeletedCount());
				echo "<br>";
		}
    }

    /**
     * perform the logout
     */
    public function doLogout()
    {
        // delete the session of the user by emptying the arrays
        $_SESSION = array();
        session_destroy();
        // return a little feeedback message
        $this->messages[] = "You have been logged out.";
		$this->successful = true;
		header("Location: /");
		exit();
    }

    /**
     * simply return the current state of the user's login
     * @return boolean user's login status
     */
    public function isUserLoggedIn()
    {
        if (isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] == 1) {
            return true;
        }
        // default return
        return false;
    }
}