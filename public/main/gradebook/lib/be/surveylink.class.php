<?php

/* For licensing terms, see /license.txt */

use Chamilo\CoreBundle\Framework\Container;
<<<<<<< HEAD
=======
use Chamilo\CourseBundle\Entity\CSurvey;
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94

/**
 * Gradebook link to a survey item.
 *
 * @author Ivan Tcholakov <ivantcholakov@gmail.com>, 2010
 */
class SurveyLink extends AbstractLink
{
<<<<<<< HEAD
    private $survey_table;
    /** @var \Chamilo\CourseBundle\Entity\CSurvey */
=======
    /** @var CSurvey */
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
    private $survey_data;

    /**
     * Constructor.
     */
    public function __construct()
    {
        parent::__construct();
        $this->set_type(LINK_SURVEY);
    }

<<<<<<< HEAD
    /**
     * @return string
     */
    public function get_name()
    {
        $this->get_survey_data();

        return $this->survey_data->getCode().': '.self::html_to_text($this->survey_data->getTitle());
    }

    /**
     * @return string
     */
    public function get_description()
    {
        $this->get_survey_data();

        return $this->survey_data->getSubtitle();
    }

    /**
     * @return string
     */
    public function get_type_name()
=======
    public function get_name(): string
    {
        $survey = $this->get_survey_data();

        if (!$survey instanceof CSurvey) {
            return get_lang('Untitled Survey');
        }

        return $survey->getCode() . ': ' . self::html_to_text($survey->getTitle());
    }

    public function get_description(): string
    {
        $survey = $this->get_survey_data();

        if (!$survey instanceof CSurvey) {
            return '';
        }

        return $survey->getSubtitle();
    }

    public function get_type_name(): string
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
    {
        return get_lang('Survey');
    }

<<<<<<< HEAD
    public function is_allowed_to_change_name()
=======
    public function is_allowed_to_change_name(): bool
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
    {
        return false;
    }

<<<<<<< HEAD
    public function needs_name_and_description()
=======
    public function needs_name_and_description(): bool
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
    {
        return false;
    }

<<<<<<< HEAD
    public function needs_max()
=======
    public function needs_max(): bool
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
    {
        return false;
    }

<<<<<<< HEAD
    public function needs_results()
=======
    public function needs_results(): bool
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
    {
        return false;
    }

    /**
     * Generates an array of all surveys available.
     *
     * @return array 2-dimensional array - every element contains 2 subelements (id, name)
     */
<<<<<<< HEAD
    public function get_all_links()
    {
        if (empty($this->course_id)) {
            exit('Error in get_all_links() : course ID not set');
        }
        $sessionId = $this->get_session_id();
        $course_id = $this->getCourseId();

        $repo = Container::getSurveyRepository();
        $course = api_get_course_entity($course_id);
        $session = !empty($sessionId) ? api_get_session_entity($sessionId) : null;
=======
    public function get_all_links(): array
    {
        if (empty($this->course_id)) {
            return [];
        }

        $session = api_get_session_entity($this->get_session_id());
        $course = api_get_course_entity($this->getCourseId());
        $repo = Container::getSurveyRepository();
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94

        $qb = $repo->getResourcesByCourse($course, $session);
        $surveys = $qb->getQuery()->getResult();
        $links = [];
<<<<<<< HEAD
        /** @var \Chamilo\CourseBundle\Entity\CSurvey $survey */
=======
        /** @var CSurvey $survey */
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
        foreach ($surveys as $survey) {
            $links[] = [
                $survey->getIid(),
                api_trunc_str(
<<<<<<< HEAD
                    $survey->getCode().': '.self::html_to_text($survey->getTitle()),
=======
                    $survey->getCode() . ': ' . self::html_to_text($survey->getTitle()),
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
                    80
                ),
            ];
        }

        return $links;
    }

    /**
     * Has anyone done this survey yet?
     * Implementation of the AbstractLink class, mainly used dynamically in gradebook/lib/fe.
     */
<<<<<<< HEAD
    public function has_results()
    {
        $ref_id = $this->get_ref_id();
        $sessionId = $this->get_session_id();
        $courseId = $this->getCourseId();

        $tbl_survey = Database::get_course_table(TABLE_SURVEY);
        $table = Database::get_course_table(TABLE_SURVEY_INVITATION);
        $sql = "SELECT
                COUNT(i.answered)
                FROM $tbl_survey AS s
                INNER JOIN $table AS i
                ON s.code = i.survey_code
                WHERE
                    i.c_id = $courseId AND
                    s.iid = $ref_id AND
                    i.session_id = $sessionId";

        $sql_result = Database::query($sql);
        $data = Database::fetch_array($sql_result);

        return 0 != $data[0];
=======
    public function has_results(): bool
    {
        $survey = $this->get_survey_data();
        if (!$survey) {
            return false;
        }

        $repo = Container::getSurveyInvitationRepository();
        $course = api_get_course_entity($this->course_id);
        $session = api_get_session_entity($this->get_session_id());

        $results = $repo->getAnsweredInvitations($survey, $course, $session);

        return count($results) > 0;
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
    }

    /**
     * Calculate score for a student (to show in the gradebook).
     *
     * @param int    $studentId
     * @param string $type      Type of result we want (best|average|ranking)
     *
     * @return array|null
     */
<<<<<<< HEAD
    public function calc_score($studentId = null, $type = null)
    {
        // Note: Max score is assumed to be always 1 for surveys,
        // only student's participation is to be taken into account.
        $max_score = 1;
        $ref_id = $this->get_ref_id();
        $sessionId = $this->get_session_id();
        $courseId = $this->getCourseId();
        $tbl_survey = Database::get_course_table(TABLE_SURVEY);
        $tbl_survey_invitation = Database::get_course_table(TABLE_SURVEY_INVITATION);
        $get_individual_score = !is_null($studentId);

        $sql = "SELECT i.answered
                FROM $tbl_survey AS s
                JOIN $tbl_survey_invitation AS i
                ON s.code = i.survey_code
                WHERE
                    i.c_id = $courseId AND
                    s.iid = $ref_id AND
                    i.session_id = $sessionId
                ";

        if ($get_individual_score) {
            $sql .= ' AND i.user = '.intval($studentId);
        }

        $sql_result = Database::query($sql);

        if ($get_individual_score) {
            // for 1 student
            if ($data = Database::fetch_array($sql_result)) {
                return [$data['answered'] ? $max_score : 0, $max_score];
            }

            return [0, $max_score];
        } else {
            // for all the students -> get average
            $rescount = 0;
            $sum = 0;
            $bestResult = 0;
            while ($data = Database::fetch_array($sql_result)) {
                $sum += $data['answered'] ? $max_score : 0;
                $rescount++;
                if ($data['answered'] > $bestResult) {
                    $bestResult = $data['answered'];
                }
            }
            $sum = $sum / $max_score;

            if (0 == $rescount) {
                return [null, null];
            }

            switch ($type) {
                case 'best':
                    return [$bestResult, $rescount];
                    break;
                case 'average':
                    return [$sum, $rescount];
                    break;
                case 'ranking':
                    return null;
                    break;
                default:
                    return [$sum, $rescount];
                    break;
            }
=======
    public function calc_score($studentId = null, $type = null): ?array
    {
        $survey = $this->get_survey_data();
        if (!$survey) {
            return [null, null];
        }

        $course = api_get_course_entity($this->course_id);
        $session = api_get_session_entity($this->get_session_id());
        $repo = Container::getSurveyInvitationRepository();
        $max_score = 1;

        if ($studentId) {
            $user = api_get_user_entity($studentId);
            $answered = $repo->hasUserAnswered($survey, $course, $user, $session);

            return [$answered ? $max_score : 0, $max_score];
        }

        $results = $repo->getAnsweredInvitations($survey, $course, $session);
        $rescount = count($results);

        if ($rescount === 0) {
            return [null, null];
        }

        switch ($type) {
            case 'best':
            case 'average':
            default:
                return [$rescount, $rescount];
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
        }
    }

    /**
     * Check if this still links to a survey.
     */
<<<<<<< HEAD
    public function is_valid_link()
    {
        $sessionId = $this->get_session_id();
        $courseId = $this->getCourseId();

        $sql = 'SELECT count(iid) FROM '.$this->get_survey_table().'
                 WHERE
                    c_id = '.$courseId.' AND
                    iid = '.$this->get_ref_id().' AND
                    session_id = '.$sessionId;
        $result = Database::query($sql);
        $number = Database::fetch_row($result);

        return 0 != $number[0];
    }

    public function get_link()
=======
    public function is_valid_link(): bool
    {
        return null !== $this->get_survey_data();
    }

    public function get_link(): ?string
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
    {
        if ('true' === api_get_setting('survey.hide_survey_reporting_button')) {
            return null;
        }

        if (api_is_allowed_to_edit()) {
<<<<<<< HEAD
            // Let students make access only through "Surveys" tool.
            $sessionId = $this->get_session_id();
            $courseId = $this->getCourseId();
            $survey = $this->get_survey_data();
            if ($survey) {
                $survey_id = $survey->getIid();

                return api_get_path(WEB_CODE_PATH).'survey/reporting.php?'.
                    api_get_cidreq_params($this->getCourseId(), $sessionId).'&survey_id='.$survey_id;
=======
            $survey = $this->get_survey_data();
            $sessionId = $this->get_session_id();

            if ($survey) {
                return api_get_path(WEB_CODE_PATH) . 'survey/reporting.php?' .
                    api_get_cidreq_params($this->getCourseId(), $sessionId) .
                    '&survey_id=' . $survey->getIid();
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
            }
        }

        return null;
    }

    /**
     * Get the name of the icon for this tool.
<<<<<<< HEAD
     *
     * @return string
     */
    public function get_icon_name()
=======
     */
    public function get_icon_name(): string
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
    {
        return 'survey';
    }

    /**
<<<<<<< HEAD
     * Lazy load function to get the database table of the surveys.
     */
    private function get_survey_table()
    {
        $this->survey_table = Database::get_course_table(TABLE_SURVEY);

        return $this->survey_table;
    }

    /**
     * Get the survey data from the c_survey table with the current object id.
     *
     * @return \Chamilo\CourseBundle\Entity\CSurvey
     */
    private function get_survey_data()
    {
        if (empty($this->survey_data)) {
            $courseId = $this->getCourseId();
            $sessionId = $this->get_session_id();
            $repo = Container::getSurveyRepository();
            $survey = $repo->find($this->get_ref_id());
=======
     * Get the survey data from the c_survey table with the current object id.
     */
    private function get_survey_data(): ?CSurvey
    {
        if (empty($this->survey_data)) {
            $repo = Container::getSurveyRepository();
            $survey = $repo->find($this->get_ref_id());

            if (!$survey instanceof CSurvey) {
                return null;
            }

>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
            $this->survey_data = $survey;
        }

        return $this->survey_data;
    }

    /**
     * @param string $string
<<<<<<< HEAD
     *
     * @return string
     */
    private static function html_to_text($string)
=======
     */
    private static function html_to_text($string): string
>>>>>>> 8289a8907bd6f2f5489816fb57201d885aa00f94
    {
        return strip_tags($string);
    }
}
