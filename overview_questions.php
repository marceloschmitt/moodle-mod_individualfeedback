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
 * shows an analysed view of individualfeedback based on subtab
 *
 * @copyright Martijn Spruijt
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package mod_individualfeedback
 */

defined('MOODLE_INTERNAL') || die();

// Show the summary.
$summary = new mod_individualfeedback\output\summary($feedbackstructure);
echo $OUTPUT->render_from_template('mod_individualfeedback/summary', $summary->export_for_template($OUTPUT));

// Get the items of the individualfeedback.
$items = $feedbackstructure->get_items();

echo html_writer::start_tag('div', array('class' => 'clear'));
// Print the items in an analysed form.
foreach ($items as $item) {
    $itemobj = individualfeedback_get_item_class($item->typ);
    if (method_exists($itemobj, 'print_overview_questions')) {
        $printnr = ($feedback->autonumbering && $item->itemnr) ? ($item->itemnr . '.') : '';
        $itemobj->print_overview_questions($item, $printnr);
    }
}
echo html_writer::end_tag('div');
