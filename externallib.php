<?php

require_once($CFG->libdir . "/externallib.php");
require_once($CFG->libdir . '/../config.php');
require_once($CFG->libdir . "/completionlib.php");

class local_ws_completion_external extends external_api {

    /**
     * Returns description of method parameters
     * @return external_function_parameters
     */
    public static function get_for_course_parameters() {
        return new external_function_parameters(
                array('courseid' => new external_value(PARAM_INT, 'id of course'))
        );
    }

    /**
     * Returns welcome message
     * @return string welcome message
     */
    public static function get_for_course($courseid) {
		global $DB;
		$course = $DB->get_record('course', array('id' => $courseid), '*', MUST_EXIST);
		$completion = new completion_info($course);
		$users = $completion->get_tracked_users();
		
		$results = array();
		
		foreach ($users as $user) {
			array_push($results, array(
                    'courseid' => $courseid,
                    'userid' => $user->id,
                    'complete' => $completion->is_course_complete($user->id),
                )
			);
		}
	
        return (array)$results;
    }

    /**
     * Returns description of method result value
     * @return external_description
     */
    public static function get_for_course_returns() {
        return new external_multiple_structure(
            new external_single_structure(
                array(
                    'courseid' => new external_value(PARAM_INT, 'id of course'),
                    'userid' => new external_value(PARAM_INT, 'id of user'),
                    'complete' => new external_value(PARAM_BOOL, 'whether user has completed course'),
                )
            )
        );
    }



}
