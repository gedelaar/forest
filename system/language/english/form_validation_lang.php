<?php

/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2017, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (https://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2017, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 * @since	Version 1.0.0
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

$lang['form_validation_required'] = '<b>{field}</b> is verplicht.';
$lang['form_validation_isset'] = 'Het {field} veld moet een waarde hebben.';
$lang['form_validation_valid_email'] = 'Het {field} veld moet een valide email address bevatten.';
$lang['form_validation_valid_emails'] = 'Het {field} veld moet allemaal valide email addresses bevatten.';
$lang['form_validation_valid_url'] = 'Het {field} veld moet een valide URL bevatten.';
$lang['form_validation_valid_ip'] = 'Het {field} veld moet een valid IP bevatten.';
$lang['form_validation_min_length'] = 'Het {field} veld moet be at least {param} characters in length.';
$lang['form_validation_max_length'] = 'Het {field} veld cannot exceed {param} characters in length.';
$lang['form_validation_exact_length'] = 'Het {field} veld moet be exactly {param} characters in length.';
$lang['form_validation_alpha'] = 'Het {field} veld mag only bevat alphabetical characters.';
$lang['form_validation_alpha_numeric'] = 'Het {field} veld mag only bevat alpha-numeric characters.';
$lang['form_validation_alpha_numeric_spaces'] = 'Het {field} veld mag only bevat alpha-numeric characters and spaces.';
$lang['form_validation_alpha_dash'] = 'Het {field} veld mag only bevat alpha-numeric characters, underscores, and dashes.';
$lang['form_validation_numeric'] = 'Het {field} veld moet bevat only numbers.';
$lang['form_validation_is_numeric'] = 'Het {field} veld moet bevat only numeric characters.';
$lang['form_validation_integer'] = 'Het {field} veld moet bevat an integer.';
$lang['form_validation_regex_match'] = 'Het {field} veld is not in the correct format.';
$lang['form_validation_matches'] = 'Het {field} veld does not match the {param} veld.';
$lang['form_validation_differs'] = 'Het {field} veld moet differ from the {param} veld.';
$lang['form_validation_is_unique'] = 'Het {field} veld moet bevat a unique value.';
$lang['form_validation_is_natural'] = 'Het {field} veld moet only bevat digits.';
$lang['form_validation_is_natural_no_zero'] = 'Het {field} veld moet only bevat digits and moet be greater than zero.';
$lang['form_validation_decimal'] = 'Het {field} veld moet bevat a decimal number.';
$lang['form_validation_less_than'] = 'Het {field} veld moet bevat a number less than {param}.';
$lang['form_validation_less_than_equal_to'] = 'Het {field} veld moet bevat a number less than or equal to {param}.';
$lang['form_validation_greater_than'] = 'Het {field} veld moet bevat a number greater than {param}.';
$lang['form_validation_greater_than_equal_to'] = 'Het {field} veld moet bevat a number greater than or equal to {param}.';
$lang['form_validation_error_message_not_set'] = 'Unable to access an error message corresponding to your veld name {field}.';
$lang['form_validation_in_list'] = 'Het {field} veld moet be one of: {param}.';
