<?php 

    // Function: isAdmin
    if (!function_exists('isAdmin')){
        function is_admin($user) {
            if($user->role == '1') {
                return True;
            } else {
                return False;
            }
        }
    }

?>