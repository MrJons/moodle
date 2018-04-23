<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Recycle bin backup cron task.
 *
 * @package    tool_recyclebin
 * @copyright  AVADO 2018
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

namespace tool_recyclebin\task;

use tool_recyclebin\course_bin;

class category_bin_item extends \core\task\adhoc_task {

    /**
     * Task name.
     */
    public function get_name() {
        return get_string('categorybinitem', 'tool_recyclebin');
    }

    /**
     * Add deleted item to recyclebin.
     * @param $cm \stdClass $cm The course module record.
     * @return bool
     */
    public function execute() {
        $cm = self::get_custom_data();
        $coursebin = new course_bin($cm->course);
        try {
            $coursebin->store_item($cm);
        } catch (\moodle_exception $e) {
            // Something went wrong.
        }
        return true;
    }
}