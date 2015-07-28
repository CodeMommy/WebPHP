<?php
/**
 * Project:     Smarty: the PHP compiling template engine
 * File:        Smarty.class.php
 *
 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 * For questions, help, comments, discussion, etc., please join the
 * Smarty mailing list. Send a blank e-mail to
 * smarty-discussion-subscribe@googlegroups.com
 *
 * @link      http://www.smarty.net/
 * @copyright 2015 New Digital Group, Inc.
 * @copyright 2015 Uwe Tews
 * @author    Monte Ohrt <monte at ohrt dot com>
 * @author    Uwe Tews
 * @author    Rodney Rehm
 * @package   Smarty
 * @version   3.1.28-dev
 */

/**
 * define shorthand directory separator constant
 */
if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}

/**
 * set SMARTY_DIR to absolute path to Smarty library files.
 * Sets SMARTY_DIR only if user application has not already defined it.
 */
if (!defined('SMARTY_DIR')) {
    define('SMARTY_DIR', dirname(__FILE__) . DS);
}

/**
 * set SMARTY_SYSPLUGINS_DIR to absolute path to Smarty internal plugins.
 * Sets SMARTY_SYSPLUGINS_DIR only if user application has not already defined it.
 */
if (!defined('SMARTY_SYSPLUGINS_DIR')) {
    define('SMARTY_SYSPLUGINS_DIR', SMARTY_DIR . 'sysplugins' . DS);
}
if (!defined('SMARTY_PLUGINS_DIR')) {
    define('SMARTY_PLUGINS_DIR', SMARTY_DIR . 'plugins' . DS);
}
if (!defined('SMARTY_MBSTRING')) {
    define('SMARTY_MBSTRING', function_exists('mb_get_info'));
}
if (!defined('SMARTY_RESOURCE_CHAR_SET')) {
    // UTF-8 can only be done properly when mbstring is available!
    /**
     * @deprecated in favor of Smarty::$_CHARSET
     */
    define('SMARTY_RESOURCE_CHAR_SET', SMARTY_MBSTRING ? 'UTF-8' : 'ISO-8859-1');
}
if (!defined('SMARTY_RESOURCE_DATE_FORMAT')) {
    /**
     * @deprecated in favor of Smarty::$_DATE_FORMAT
     */
    define('SMARTY_RESOURCE_DATE_FORMAT', '%b %e, %Y');
}

/**
 * Try loading the Smarty_Internal_Data class
 * If we fail we must load Smarty's autoloader.
 * Otherwise we may have a global autoloader like Composer
 */
if (!class_exists('Smarty_Autoloader', false)) {
    if (!class_exists('Smarty_Internal_Data', true)) {
        require_once 'Autoloader.php';
        Smarty_Autoloader::registerBC();
    }
}

/**
 * Load always needed external class files
 */

if (!class_exists('Smarty_Internal_Data', false)) {
    require_once SMARTY_SYSPLUGINS_DIR . 'smarty_internal_data.php';
}
require_once SMARTY_SYSPLUGINS_DIR . 'smarty_internal_templatebase.php';
require_once SMARTY_SYSPLUGINS_DIR . 'smarty_internal_template.php';
require_once SMARTY_SYSPLUGINS_DIR . 'smarty_resource.php';
require_once SMARTY_SYSPLUGINS_DIR . 'smarty_variable.php';
require_once SMARTY_SYSPLUGINS_DIR . 'smarty_template_source.php';

/**
 * This is the main Smarty class
 *
 * @package Smarty
 */
class Smarty extends Smarty_Internal_TemplateBase
{
    /**#@+
     * constant definitions
     */

    /**
     * smarty version
     */
    const SMARTY_VERSION = '3.1.28-dev/32';

    /**
     * define variable scopes
     */
    const SCOPE_LOCAL = 0;

    const SCOPE_PARENT = 1;

    const SCOPE_ROOT = 2;

    const SCOPE_GLOBAL = 3;

    /**
     * define caching modes
     */
    const CACHING_OFF = 0;

    const CACHING_LIFETIME_CURRENT = 1;

    const CACHING_LIFETIME_SAVED = 2;

    /**
     * define constant for clearing cache files be saved expiration dates
     */
    const CLEAR_EXPIRED = - 1;

    /**
     * define compile check modes
     */
    const COMPILECHECK_OFF = 0;

    const COMPILECHECK_ON = 1;

    const COMPILECHECK_CACHEMISS = 2;

    /**
     * define debug modes
     */
    const DEBUG_OFF = 0;

    const DEBUG_ON = 1;

    const DEBUG_INDIVIDUAL = 2;

    /**
     * modes for handling of "<?php ... ?>" tags in templates.
     */
    const PHP_PASSTHRU = 0; //-> print tags as plain text

    const PHP_QUOTE = 1; //-> escape tags as entities

    const PHP_REMOVE = 2; //-> escape tags as entities

    const PHP_ALLOW = 3; //-> escape tags as entities

    /**
     * filter types
     */
    const FILTER_POST = 'post';

    const FILTER_PRE = 'pre';

    const FILTER_OUTPUT = 'output';

    const FILTER_VARIABLE = 'variable';

    /**
     * plugin types
     */
    const PLUGIN_FUNCTION = 'function';

    const PLUGIN_BLOCK = 'block';

    const PLUGIN_COMPILER = 'compiler';

    const PLUGIN_MODIFIER = 'modifier';

    const PLUGIN_MODIFIERCOMPILER = 'modifiercompiler';

    /**#@-*/

    /**
     * assigned global tpl vars
     */
    public static $global_tpl_vars = array();

    /**
     * error handler returned by set_error_handler() in Smarty::muteExpectedErrors()
     */
    public static $_previous_error_handler = null;

    /**
     * contains directories outside of SMARTY_DIR that are to be muted by muteExpectedErrors()
     */
    public static $_muted_directories = array();

    /**
     * Flag denoting if Multibyte String functions are available
     */
    public static $_MBSTRING = SMARTY_MBSTRING;

    /**
     * The character set to adhere to (e.g. "UTF-8")
     */
    public static $_CHARSET = SMARTY_RESOURCE_CHAR_SET;

    /**
     * The date format to be used internally
     * (accepts date() and strftime())
     */
    public static $_DATE_FORMAT = SMARTY_RESOURCE_DATE_FORMAT;

    /**
     * Flag denoting if PCRE should run in UTF-8 mode
     */
    public static $_UTF8_MODIFIER = 'u';

    /**
     * Flag denoting if operating system is windows
     */
    public static $_IS_WINDOWS = false;

    /**#@+
     * variables
     */

    /**
     * auto literal on delimiters with whitspace
     *
     * @var boolean
     */
    public $auto_literal = true;

    /**
     * display error on not assigned variables
     *
     * @var boolean
     */
    public $error_unassigned = false;

    /**
     * look up relative filepaths in include_path
     *
     * @var boolean
     */
    public $use_include_path = false;

    /**
     * template directory
     *
     * @var array
     */
    private $template_dir = array('./templates/');

    /**
     * joined template directory string used in cache keys
     *
     * @var string
     */
    public $joined_template_dir = '';

    /**
     * joined config directory string used in cache keys
     *
     * @var string
     */
    public $joined_config_dir = '';

    /**
     * default template handler
     *
     * @var callable
     */
    public $default_template_handler_func = null;

    /**
     * default config handler
     *
     * @var callable
     */
    public $default_config_handler_func = null;

    /**
     * default plugin handler
     *
     * @var callable
     */
    public $default_plugin_handler_func = null;

    /**
     * compile directory
     *
     * @var string
     */
    private $compile_dir = './templates_c/';

    /**
     * plugins directory
     *
     * @var array
     */
    private $plugins_dir = null;

    /**
     * cache directory
     *
     * @var string
     */
    private $cache_dir = './cache/';

    /**
     * config directory
     *
     * @var array
     */
    private $config_dir = array('./configs/');

    /**
     * force template compiling?
     *
     * @var boolean
     */
    public $force_compile = false;

    /**
     * check template for modifications?
     *
     * @var boolean
     */
    public $compile_check = true;

    /**
     * use sub dirs for compiled/cached files?
     *
     * @var boolean
     */
    public $use_sub_dirs = false;

    /**
     * allow ambiguous resources (that are made unique by the resource handler)
     *
     * @var boolean
     */
    public $allow_ambiguous_resources = false;

    /**
     * merge compiled includes
     *
     * @var boolean
     */
    public $merge_compiled_includes = false;

    /**
     * template inheritance merge compiled includes
     *
     * @var boolean
     */
    public $inheritance_merge_compiled_includes = true;

    /**
     * force cache file creation
     *
     * @var boolean
     */
    public $force_cache = false;

    /**
     * template left-delimiter
     *
     * @var string
     */
    public $left_delimiter = "{";

    /**
     * template right-delimiter
     *
     * @var string
     */
    public $right_delimiter = "}";

    /**#@+
     * security
     */
    /**
     * class name
     * This should be instance of Smarty_Security.
     *
     * @var string
     * @see Smarty_Security
     */
    public $security_class = 'Smarty_Security';

    /**
     * implementation of security class
     *
     * @var Smarty_Security
     */
    public $security_policy = null;

    /**
     * controls handling of PHP-blocks
     *
     * @var integer
     */
    public $php_handling = self::PHP_PASSTHRU;

    /**
     * controls if the php template file resource is allowed
     *
     * @var bool
     */
    public $allow_php_templates = false;

    /**
     * Should compiled-templates be prevented from being called directly?
     * {@internal
     * Currently used by Smarty_Internal_Template only.
     * }}
     *
     * @var boolean
     */
    public $direct_access_security = true;

    /**#@-*/
    /**
     * debug mode
     * Setting this to true enables the debug-console.
     *
     * @var boolean
     */
    public $debugging = false;

    /**
     * This determines if debugging is enable-able from the browser.
     * <ul>
     *  <li>NONE => no debugging control allowed</li>
     *  <li>URL => enable debugging when SMARTY_DEBUG is found in the URL.</li>
     * </ul>
     *
     * @var string
     */
    public $debugging_ctrl = 'NONE';

    /**
     * Name of debugging URL-param.
     * Only used when $debugging_ctrl is set to 'URL'.
     * The name of the URL-parameter that activates debugging.
     *
     * @var string
     */
    public $smarty_debug_id = 'SMARTY_DEBUG';

    /**
     * Path of debug template.
     *
     * @var string
     */
    public $debug_tpl = null;

    /**
     * When set, smarty uses this value as error_reporting-level.
     *
     * @var int
     */
    public $error_reporting = null;

    /**
     * Internal flag for getTags()
     *
     * @var boolean
     */
    public $get_used_tags = false;

    /**#@+
     * config var settings
     */

    /**
     * Controls whether variables with the same name overwrite each other.
     *
     * @var boolean
     */
    public $config_overwrite = true;

    /**
     * Controls whether config values of on/true/yes and off/false/no get converted to boolean.
     *
     * @var boolean
     */
    public $config_booleanize = true;

    /**
     * Controls whether hidden config sections/vars are read from the file.
     *
     * @var boolean
     */
    public $config_read_hidden = false;

    /**#@-*/

    /**#@+
     * resource locking
     */

    /**
     * locking concurrent compiles
     *
     * @var boolean
     */
    public $compile_locking = true;

    /**
     * Controls whether cache resources should use locking mechanism
     *
     * @var boolean
     */
    public $cache_locking = false;

    /**
     * seconds to wait for acquiring a lock before ignoring the write lock
     *
     * @var float
     */
    public $locking_timeout = 10;

    /**#@-*/

    /**
     * resource type used if none given
     * Must be an valid key of $registered_resources.
     *
     * @var string
     */
    public $default_resource_type = 'file';

    /**
     * caching type
     * Must be an element of $cache_resource_types.
     *
     * @var string
     */
    public $caching_type = 'file';

    /**
     * internal config properties
     *
     * @var array
     */
    public $properties = array();

    /**
     * config type
     *
     * @var string
     */
    public $default_config_type = 'file';

    /**
     * cached template objects
     *
     * @var array
     */
    public $source_objects = array();

    /**
     * cached template objects
     *
     * @var array
     */
    public $template_objects = array();

    /**
     * enable resource caching
     *
     * @var bool
     */
    public $resource_caching = false;

    /**
     * enable template resource caching
     *
     * @var bool
     */
    public $template_resource_caching = true;

    /**
     * check If-Modified-Since headers
     *
     * @var boolean
     */
    public $cache_modified_check = false;

    /**
     * registered plugins
     *
     * @var array
     */
    public $registered_plugins = array();

    /**
     * plugin search order
     *
     * @var array
     */
    public $plugin_search_order = array('function', 'block', 'compiler', 'class');

    /**
     * registered objects
     *
     * @var array
     */
    public $registered_objects = array();

    /**
     * registered classes
     *
     * @var array
     */
    public $registered_classes = array();

    /**
     * registered filters
     *
     * @var array
     */
    public $registered_filters = array();

    /**
     * registered resources
     *
     * @var array
     */
    public $registered_resources = array();

    /**
     * resource handler cache
     *
     * @var array
     */
    public $_resource_handlers = array();

    /**
     * registered cache resources
     *
     * @var array
     */
    public $registered_cache_resources = array();

    /**
     * cache resource handler cache
     *
     * @var array
     */
    public $_cacheresource_handlers = array();

    /**
     * autoload filter
     *
     * @var array
     */
    public $autoload_filters = array();

    /**
     * default modifier
     *
     * @var array
     */
    public $default_modifiers = array();

    /**
     * autoescape variable output
     *
     * @var boolean
     */
    public $escape_html = false;

    /**
     * global internal smarty vars
     *
     * @var array
     */
    public static $_smarty_vars = array();

    /**
     * start time for execution time calculation
     *
     * @var int
     */
    public $start_time = 0;

    /**
     * default file permissions
     *
     * @var int
     */
    public $_file_perms = 0644;

    /**
     * default dir permissions
     *
     * @var int
     */
    public $_dir_perms = 0771;

    /**
     * block tag hierarchy
     *
     * @var array
     */
    public $_tag_stack = array();

    /**
     * required by the compiler for BC
     *
     * @var string
     */
    public $_current_file = null;

    /**
     * internal flag to enable parser debugging
     *
     * @var bool
     */
    public $_parserdebug = false;

    /**#@-*/

    /**
     * Initialize new Smarty object
     */
    public function __construct()
    {
        if (is_callable('mb_internal_encoding')) {
            mb_internal_encoding(Smarty::$_CHARSET);
        }
        $this->start_time = microtime(true);

        if (isset($_SERVER['SCRIPT_NAME'])) {
            Smarty::$global_tpl_vars['SCRIPT_NAME'] = new Smarty_Variable($_SERVER['SCRIPT_NAME']);
        }

        // Check if we're running on windows
        Smarty::$_IS_WINDOWS = strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';

        // let PCRE (preg_*) treat strings as ISO-8859-1 if we're not dealing with UTF-8
        if (Smarty::$_CHARSET !== 'UTF-8') {
            Smarty::$_UTF8_MODIFIER = '';
        }
    }

    /**
     * fetches a rendered Smarty template
     *
     * @param  string $template         the resource handle of the template file or template object
     * @param  mixed  $cache_id         cache id to be used with this template
     * @param  mixed  $compile_id       compile id to be used with this template
     * @param  object $parent           next higher level of Smarty variables
     * @param  bool   $display          true: display, false: fetch
     * @param  bool   $merge_tpl_vars   not used - left for BC
     * @param  bool   $no_output_filter not used - left for BC
     *
     * @throws Exception
     * @throws SmartyException
     * @return string rendered template output
     */
    public function fetch($template, $cache_id = null, $compile_id = null, $parent = null, $display = false, $merge_tpl_vars = true, $no_output_filter = false)
    {
        $this->_cache['core'] = array();
        if ($cache_id !== null && is_object($cache_id)) {
            $parent = $cache_id;
            $cache_id = null;
        }
        if ($parent === null) {
            $parent = $this;
        }
        // get template object
        $_template = is_object($template) ? $template : $this->createTemplate($template, $cache_id, $compile_id, $parent, false);
        // set caching in template object
        $_template->caching = $this->caching;
        // fetch template content
        return $_template->render(true, false, $display);
    }

    /**
     * displays a Smarty template
     *
     * @param string $template   the resource handle of the template file or template object
     * @param mixed  $cache_id   cache id to be used with this template
     * @param mixed  $compile_id compile id to be used with this template
     * @param object $parent     next higher level of Smarty variables
     */
    public function display($template, $cache_id = null, $compile_id = null, $parent = null)
    {
        // display template
        $this->fetch($template, $cache_id, $compile_id, $parent, true);
    }

    /**
     * Check if a template resource exists
     *
     * @param  string $resource_name template name
     *
     * @return boolean status
     */
    public function templateExists($resource_name)
    {
        // create template object
        $save = $this->template_objects;
        $tpl = new $this->template_class($resource_name, $this);
        // check if it does exists
        $result = $tpl->source->exists;
        $this->template_objects = $save;

        return $result;
    }

    /**
     * Returns a single or all global  variables
     *
     * @param  string $varname variable name or null
     *
     * @return string variable value or or array of variables
     */
    public function getGlobal($varname = null)
    {
        if (isset($varname)) {
            if (isset(self::$global_tpl_vars[$varname])) {
                return self::$global_tpl_vars[$varname]->value;
            } else {
                return '';
            }
        } else {
            $_result = array();
            foreach (self::$global_tpl_vars AS $key => $var) {
                $_result[$key] = $var->value;
            }

            return $_result;
        }
    }

    /**
     * Empty cache folder
     *
     * @param  integer $exp_time expiration time
     * @param  string  $type     resource type
     *
     * @return integer number of cache files deleted
     */
    public function clearAllCache($exp_time = null, $type = null)
    {
        // load cache resource and call clearAll
        $_cache_resource = Smarty_CacheResource::load($this, $type);
        Smarty_CacheResource::invalidLoadedCache($this);

        return $_cache_resource->clearAll($this, $exp_time);
    }

    /**
     * Empty cache for a specific template
     *
     * @param  string  $template_name template name
     * @param  string  $cache_id      cache id
     * @param  string  $compile_id    compile id
     * @param  integer $exp_time      expiration time
     * @param  string  $type          resource type
     *
     * @return integer number of cache files deleted
     */
    public function clearCache($template_name, $cache_id = null, $compile_id = null, $exp_time = null, $type = null)
    {
        // load cache resource and call clear
        $_cache_resource = Smarty_CacheResource::load($this, $type);
        Smarty_CacheResource::invalidLoadedCache($this);

        return $_cache_resource->clear($this, $template_name, $cache_id, $compile_id, $exp_time);
    }

    /**
     * Loads security class and enables security
     *
     * @param  string|Smarty_Security $security_class if a string is used, it must be class-name
     *
     * @return Smarty                 current Smarty instance for chaining
     * @throws SmartyException        when an invalid class name is provided
     */
    public function enableSecurity($security_class = null)
    {
        Smarty_Security::enableSecurity($this, $security_class);
        return $this;
    }

    /**
     * Disable security
     *
     * @return Smarty current Smarty instance for chaining
     */
    public function disableSecurity()
    {
        $this->security_policy = null;

        return $this;
    }

    /**
     * Set template directory
     *
     * @param  string|array $template_dir directory(s) of template sources
     * @param bool          $isConfig     true for config_dir
     *
     * @return \Smarty current Smarty instance for chaining
     */
    public function setTemplateDir($template_dir, $isConfig = false)
    {
        $type = $isConfig ? 'config_dir' : 'template_dir';
        $joined = 'joined_' . $type;
        $this->{$type} = (array) $template_dir;
        $this->{$joined} = join(' # ', $this->{$type});
        $this->_cache[$type . '_new'] = true;
        $this->_cache[$type] = false;
        return $this;
    }

    /**
     * Add template directory(s)
     *
     * @param  string|array $template_dir directory(s) of template sources
     * @param  string       $key          of the array element to assign the template dir to
     * @param bool          $isConfig     true for config_dir
     *
     * @return Smarty          current Smarty instance for chaining
     */
    public function addTemplateDir($template_dir, $key = null, $isConfig = false)
    {
        $type = $isConfig ? 'config_dir' : 'template_dir';
        $joined = 'joined_' . $type;
        if (!isset($this->_cache[$type])) {
            $this->{$type} = (array) $this->{$type};
            $this->{$joined} = join(' # ', $this->{$type});
            $this->_cache[$type . '_new'] = true;
            $this->_cache[$type] = false;
        }
        $this->{$joined} .= ' # ' . join(' # ', (array) $template_dir);
        $this->_addDir($type, $template_dir, $key);
        return $this;
    }

    /**
     * Get template directories
     *
     * @param mixed $index    index of directory to get, null to get all
     * @param bool  $isConfig true for config_dir
     *
     * @return array list of template directories, or directory of $index
     */
    public function getTemplateDir($index = null, $isConfig = false)
    {
        $type = $isConfig ? 'config_dir' : 'template_dir';
        if (!isset($this->_cache[$type])) {
            $joined = 'joined_' . $type;
            $this->{$type} = (array) $this->{$type};
            $this->{$joined} = join(' # ', $this->{$type});
            $this->_cache[$type] = false;
        }
        if ($this->_cache[$type] == false) {
            foreach ($this->{$type} as $k => $v) {
                $this->{$type}[$k] = $this->_realpath($v . DS, true);
            }
            $this->_cache[$type . '_new'] = true;
            $this->_cache[$type] = true;
        }
        if ($index !== null) {
            return isset($this->{$type}[$index]) ? $this->{$type}[$index] : null;
        }
        return $this->{$type};
    }

    /**
     * Set config directory
     *
     * @param $config_dir
     *
     * @return Smarty       current Smarty instance for chaining
     */
    public function setConfigDir($config_dir)
    {
        return $this->setTemplateDir($config_dir, true);
    }

    /**
     * Add config directory(s)
     *
     * @param string|array $config_dir directory(s) of config sources
     * @param mixed        $key        key of the array element to assign the config dir to
     *
     * @return Smarty current Smarty instance for chaining
     */
    public function addConfigDir($config_dir, $key = null)
    {
        return $this->addTemplateDir($config_dir, $key, true);
    }

    /**
     * Get config directory
     *
     * @param mixed $index index of directory to get, null to get all
     *
     * @return array configuration directory
     */
    public function getConfigDir($index = null)
    {
        return $this->getTemplateDir($index, true);
    }

    /**
     * Set plugins directory
     *
     * @param  string|array $plugins_dir directory(s) of plugins
     *
     * @return Smarty       current Smarty instance for chaining
     */
    public function setPluginsDir($plugins_dir)
    {
        $this->plugins_dir = (array) $plugins_dir;
        if (isset($this->_cache['plugins_dir'])) {
            unset($this->_cache['plugins_dir']);
        }
        return $this;
    }

    /**
     * Adds directory of plugin files
     *
     * @param $plugins_dir
     *
     * @return Smarty current Smarty instance for chaining
     */
    public function addPluginsDir($plugins_dir)
    {
        if (!isset($this->plugins_dir)) {
            $this->plugins_dir = array(SMARTY_PLUGINS_DIR);
        }
        $this->plugins_dir = array_merge((array) $this->plugins_dir, (array) $plugins_dir);
        if (isset($this->_cache['plugins_dir'])) {
            unset($this->_cache['plugins_dir']);
        }
        return $this;
    }

    /**
     * Get plugin directories
     *
     * @return array list of plugin directories
     */
    public function getPluginsDir()
    {
        if (!isset($this->_cache['plugins_dir'])) {
            if (!isset($this->plugins_dir)) {
                $this->plugins_dir = array(SMARTY_PLUGINS_DIR);
            } else {
                $plugins_dir = (array) $this->plugins_dir;
                $this->plugins_dir = array();
                foreach ($plugins_dir as $v) {
                    $this->plugins_dir[] = $this->_realpath($v . DS, true);
                }
                $this->plugins_dir = array_unique($this->plugins_dir);
            }
            $this->_cache['plugin_files'] = array();
            $this->_cache['plugins_dir'] = true;
        }
        return $this->plugins_dir;
    }

    /**
     * Set compile directory
     *
     * @param  string $compile_dir directory to store compiled templates in
     *
     * @return Smarty current Smarty instance for chaining
     */
    public function setCompileDir($compile_dir)
    {
        $this->compile_dir = $this->_realpath($compile_dir . DS, true);
        if (!isset(Smarty::$_muted_directories[$this->compile_dir])) {
            Smarty::$_muted_directories[$this->compile_dir] = null;
        }
        $this->_cache['compile_dir'] = true;
        return $this;
    }

    /**
     * Get compiled directory
     *
     * @return string path to compiled templates
     */
    public function getCompileDir()
    {
        if (!isset($this->_cache['compile_dir'])) {
            $this->compile_dir = $this->_realpath($this->compile_dir . DS, true);
            if (!isset(Smarty::$_muted_directories[$this->compile_dir])) {
                Smarty::$_muted_directories[$this->compile_dir] = null;
            }
            $this->_cache['compile_dir'] = true;
        }
        return $this->compile_dir;
    }

    /**
     * Set cache directory
     *
     * @param  string $cache_dir directory to store cached templates in
     *
     * @return Smarty current Smarty instance for chaining
     */
    public function setCacheDir($cache_dir)
    {
        $this->cache_dir = $this->_realpath($cache_dir . DS, true);
        if (!isset(Smarty::$_muted_directories[$this->cache_dir])) {
            Smarty::$_muted_directories[$this->cache_dir] = null;
        }
        $this->_cache['cache_dir'] = true;
        return $this;
    }

    /**
     * Get cache directory
     *
     * @return string path of cache directory
     */
    public function getCacheDir()
    {
        if (!isset($this->_cache['cache_dir'])) {
            $this->cache_dir = $this->_realpath($this->cache_dir . DS, true);
            if (!isset(Smarty::$_muted_directories[$this->cache_dir])) {
                Smarty::$_muted_directories[$this->cache_dir] = null;
            }
            $this->_cache['cache_dir'] = true;
        }
        return $this->cache_dir;
    }

    /**
     * add directories to given property name
     *
     * @param string       $dirName directory property name
     * @param string|array $dir     directory string or array of strings
     * @param mixed        $key     optional key
     */
    private function _addDir($dirName, $dir, $key = null)
    {
        $rp = $this->_cache[$dirName];
        if (is_array($dir)) {
            foreach ($dir as $k => $v) {
                $path = $rp ? $this->_realpath($v . DS, true) : $v;
                if (is_int($k)) {
                    // indexes are not merged but appended
                    $this->{$dirName}[] = $path;
                } else {
                    // string indexes are overridden
                    $this->{$dirName}[$k] = $path;
                }
            }
        } else {
            $path = $rp ? $this->_realpath($dir . DS, true) : $dir;
            if ($key !== null) {
                // override directory at specified index
                $this->{$dirName}[$key] = $path;
            } else {
                // append new directory
                $this->{$dirName}[] = $path;
            }
        }
    }

    /**
     * Set default modifiers
     *
     * @param  array|string $modifiers modifier or list of modifiers to set
     *
     * @return Smarty       current Smarty instance for chaining
     */
    public function setDefaultModifiers($modifiers)
    {
        $this->default_modifiers = (array) $modifiers;

        return $this;
    }

    /**
     * Add default modifiers
     *
     * @param  array|string $modifiers modifier or list of modifiers to add
     *
     * @return Smarty       current Smarty instance for chaining
     */
    public function addDefaultModifiers($modifiers)
    {
        if (is_array($modifiers)) {
            $this->default_modifiers = array_merge($this->default_modifiers, $modifiers);
        } else {
            $this->default_modifiers[] = $modifiers;
        }

        return $this;
    }

    /**
     * Get default modifiers
     *
     * @return array list of default modifiers
     */
    public function getDefaultModifiers()
    {
        return $this->default_modifiers;
    }

    /**
     * Set autoload filters
     *
     * @param  array  $filters filters to load automatically
     * @param  string $type    "pre", "output", … specify the filter type to set. Defaults to none treating $filters'
     *                         keys as the appropriate types
     *
     * @return Smarty current Smarty instance for chaining
     */
    public function setAutoloadFilters($filters, $type = null)
    {
        Smarty_Internal_Extension_AutoLoadFilter::setAutoloadFilters($this, $filters, $type);
        return $this;
    }

    /**
     * Add autoload filters
     *
     * @param  array  $filters filters to load automatically
     * @param  string $type    "pre", "output", … specify the filter type to set. Defaults to none treating $filters'
     *                         keys as the appropriate types
     *
     * @return Smarty current Smarty instance for chaining
     */
    public function addAutoloadFilters($filters, $type = null)
    {
        Smarty_Internal_Extension_AutoLoadFilter::addAutoloadFilters($this, $filters, $type);
        return $this;
    }

    /**
     * Get autoload filters
     *
     * @param  string $type type of filter to get autoloads for. Defaults to all autoload filters
     *
     * @return array  array( 'type1' => array( 'filter1', 'filter2', … ) ) or array( 'filter1', 'filter2', …) if $type
     *                was specified
     */
    public function getAutoloadFilters($type = null)
    {
        return Smarty_Internal_Extension_AutoLoadFilter::getAutoloadFilters($this, $type);
    }

    /**
     * return name of debugging template
     *
     * @return string
     */
    public function getDebugTemplate()
    {
        return $this->debug_tpl;
    }

    /**
     * set the debug template
     *
     * @param  string $tpl_name
     *
     * @return Smarty          current Smarty instance for chaining
     * @throws SmartyException if file is not readable
     */
    public function setDebugTemplate($tpl_name)
    {
        if (!is_readable($tpl_name)) {
            throw new SmartyException("Unknown file '{$tpl_name}'");
        }
        $this->debug_tpl = $tpl_name;

        return $this;
    }

    /**
     * creates a template object
     *
     * @param  string  $template   the resource handle of the template file
     * @param  mixed   $cache_id   cache id to be used with this template
     * @param  mixed   $compile_id compile id to be used with this template
     * @param  object  $parent     next higher level of Smarty variables
     * @param  boolean $do_clone   flag is Smarty object shall be cloned
     *
     * @return object  template object
     */
    public function createTemplate($template, $cache_id = null, $compile_id = null, $parent = null, $do_clone = true)
    {
        if ($cache_id !== null && (is_object($cache_id) || is_array($cache_id))) {
            $parent = $cache_id;
            $cache_id = null;
        }
        if ($parent !== null && is_array($parent)) {
            $data = $parent;
            $parent = null;
        } else {
            $data = null;
        }
        $_templateId = $this->getTemplateId($template, $cache_id, $compile_id);
        if (isset($this->template_objects[$_templateId])) {
            if ($do_clone) {
                $tpl = clone $this->template_objects[$_templateId];
                $tpl->smarty = clone $tpl->smarty;
            } else {
                $tpl = $this->template_objects[$_templateId];
            }
            $tpl->parent = $parent;
            $tpl->tpl_vars = array();
            $tpl->config_vars = array();
        } else {
            $tpl = new $this->template_class($template, $this, $parent, $cache_id, $compile_id);
            if ($do_clone) {
                $tpl->smarty = clone $tpl->smarty;
            }
            $tpl->templateId = $_templateId;
        }
        // fill data if present
        if (!empty($data) && is_array($data)) {
            // set up variable values
            foreach ($data as $_key => $_val) {
                $tpl->tpl_vars[$_key] = new Smarty_Variable($_val);
            }
        }
        if ($this->debugging) {
            Smarty_Internal_Debug::register_template($tpl);
        }
        return $tpl;
    }

    /**
     * Takes unknown classes and loads plugin files for them
     * class name format: Smarty_PluginType_PluginName
     * plugin filename format: plugintype.pluginname.php
     *
     * @param  string $plugin_name class plugin name to load
     * @param  bool   $check       check if already loaded
     *
     * @throws SmartyException
     * @return string |boolean filepath of loaded file or false
     */
    public function loadPlugin($plugin_name, $check = true)
    {
        return Smarty_Internal_Extension_LoadPlugin::loadPlugin($this, $plugin_name, $check);
    }

    /**
     * Normalize path
     *  - remove /./ and /../
     *  - make it absolute if required
     *
     * @param string $path     file path
     * @param bool   $realpath leave $path relative
     *
     * @return string
     */
    public function _realpath($path, $realpath = null)
    {
        static $pattern = null;
        static $pattern2 = null;
        if ($pattern == null) {
            $pattern = '#[' . (DS == '/' ? '\\\\' : '/') . ']|([\\\/]([\\\/]|([.]+[\\\/])))#';
            $pattern2 = '#([\\\/]+[^\\\/]+[\\\/]+[.]([\\\/]+[.])*[.][\\\/]+([.][\\\/]+)*)|([\\\/]+([.][\\\/]+)+)|[\\\/]{2,}|[' .
                (DS == '/' ? '\\\\' : '/') . ']+#';
        }
        if ($realpath === true && $path[0] !== '/' && $path[1] !== ':') {
            $path = getcwd() . DS . $path;
        }
        while (preg_match($pattern, $path)) {
            $path = preg_replace($pattern2, DS, $path);
        }
        if ($realpath === false && ($path[0] == '/' || $path[1] == ':')) {
            $path = str_ireplace(getcwd(), '.', $path);
        }
        return $path;
    }

    /**
     * Compile all template files
     *
     * @param  string $extension     file extension
     * @param  bool   $force_compile force all to recompile
     * @param  int    $time_limit
     * @param  int    $max_errors
     *
     * @return integer number of template files recompiled
     */
    public function compileAllTemplates($extension = '.tpl', $force_compile = false, $time_limit = 0, $max_errors = null)
    {
        return Smarty_Internal_Utility::compileAllTemplates($extension, $force_compile, $time_limit, $max_errors, $this);
    }

    /**
     * Compile all config files
     *
     * @param  string $extension     file extension
     * @param  bool   $force_compile force all to recompile<
     * @param  int    $time_limit
     * @param  int    $max_errors
     *
     * @return integer number of template files recompiled
     */
    public function compileAllConfig($extension = '.conf', $force_compile = false, $time_limit = 0, $max_errors = null)
    {
        return Smarty_Internal_Utility::compileAllConfig($extension, $force_compile, $time_limit, $max_errors, $this);
    }

    /**
     * Delete compiled template file
     *
     * @param  string  $resource_name template name
     * @param  string  $compile_id    compile id
     * @param  integer $exp_time      expiration time
     *
     * @return integer number of template files deleted
     */
    public function clearCompiledTemplate($resource_name = null, $compile_id = null, $exp_time = null)
    {
        return Smarty_Internal_Extension_ClearCompiled::clearCompiledTemplate($this, $resource_name, $compile_id, $exp_time);
    }

    /**
     * Return array of tag/attributes of all tags used by an template
     *
     * @param Smarty_Internal_Template $template
     *
     * @return array  of tag/attributes
     */
    public function getTags(Smarty_Internal_Template $template)
    {
        return Smarty_Internal_Utility::getTags($template);
    }

    /**
     * Run installation test
     *
     * @param  array $errors Array to write errors into, rather than outputting them
     *
     * @return boolean true if setup is fine, false if something is wrong
     */
    public function testInstall(&$errors = null)
    {
        return Smarty_Internal_TestInstall::testInstall($this, $errors);
    }

    /**
     * @param boolean $compile_check
     */
    public function setCompileCheck($compile_check)
    {
        $this->compile_check = $compile_check;
    }

    /**
     * @param boolean $use_sub_dirs
     */
    public function setUseSubDirs($use_sub_dirs)
    {
        $this->use_sub_dirs = $use_sub_dirs;
    }

    /**
     * @param boolean $caching
     */
    public function setCaching($caching)
    {
        $this->caching = $caching;
    }

    /**
     * @param int $cache_lifetime
     */
    public function setCacheLifetime($cache_lifetime)
    {
        $this->cache_lifetime = $cache_lifetime;
    }

    /**
     * @param string $compile_id
     */
    public function setCompileId($compile_id)
    {
        $this->compile_id = $compile_id;
    }

    /**
     * @param string $cache_id
     */
    public function setCacheId($cache_id)
    {
        $this->cache_id = $cache_id;
    }

    /**
     * @param int $error_reporting
     */
    public function setErrorReporting($error_reporting)
    {
        $this->error_reporting = $error_reporting;
    }

    /**
     * @param boolean $escape_html
     */
    public function setEscapeHtml($escape_html)
    {
        $this->escape_html = $escape_html;
    }

    /**
     * @param boolean $auto_literal
     */
    public function setAutoLiteral($auto_literal)
    {
        $this->auto_literal = $auto_literal;
    }

    /**
     * @param boolean $force_compile
     */
    public function setForceCompile($force_compile)
    {
        $this->force_compile = $force_compile;
    }

    /**
     * @param boolean $merge_compiled_includes
     */
    public function setMergeCompiledIncludes($merge_compiled_includes)
    {
        $this->merge_compiled_includes = $merge_compiled_includes;
    }

    /**
     * @param string $left_delimiter
     */
    public function setLeftDelimiter($left_delimiter)
    {
        $this->left_delimiter = $left_delimiter;
    }

    /**
     * @param string $right_delimiter
     */
    public function setRightDelimiter($right_delimiter)
    {
        $this->right_delimiter = $right_delimiter;
    }

    /**
     * @param boolean $debugging
     */
    public function setDebugging($debugging)
    {
        $this->debugging = $debugging;
    }

    /**
     * @param boolean $config_overwrite
     */
    public function setConfigOverwrite($config_overwrite)
    {
        $this->config_overwrite = $config_overwrite;
    }

    /**
     * @param boolean $config_booleanize
     */
    public function setConfigBooleanize($config_booleanize)
    {
        $this->config_booleanize = $config_booleanize;
    }

    /**
     * @param boolean $config_read_hidden
     */
    public function setConfigReadHidden($config_read_hidden)
    {
        $this->config_read_hidden = $config_read_hidden;
    }

    /**
     * @param boolean $compile_locking
     */
    public function setCompileLocking($compile_locking)
    {
        $this->compile_locking = $compile_locking;
    }

    /**
     * Class destructor
     */
    public function __destruct()
    {
        // intentionally left blank
    }

    /**
     * <<magic>> Generic getter.
     * Calls the appropriate getter function.
     * Issues an E_USER_NOTICE if no valid getter is found.
     *
     * @param  string $name property name
     *
     * @return mixed
     */
    public function __get($name)
    {
        $allowed = array('template_dir' => 'getTemplateDir', 'config_dir' => 'getConfigDir',
                         'plugins_dir'  => 'getPluginsDir', 'compile_dir' => 'getCompileDir',
                         'cache_dir'    => 'getCacheDir',);

        if (isset($allowed[$name])) {
            return $this->{$allowed[$name]}();
        } else {
            trigger_error('Undefined property: ' . get_class($this) . '::$' . $name, E_USER_NOTICE);
        }
    }

    /**
     * <<magic>> Generic setter.
     * Calls the appropriate setter function.
     * Issues an E_USER_NOTICE if no valid setter is found.
     *
     * @param string $name  property name
     * @param mixed  $value parameter passed to setter
     */
    public function __set($name, $value)
    {
        $allowed = array('template_dir' => 'setTemplateDir', 'config_dir' => 'setConfigDir',
                         'plugins_dir'  => 'setPluginsDir', 'compile_dir' => 'setCompileDir',
                         'cache_dir'    => 'setCacheDir',);

        if (isset($allowed[$name])) {
            $this->{$allowed[$name]}($value);
        } else {
            trigger_error('Undefined property: ' . get_class($this) . '::$' . $name, E_USER_NOTICE);
        }
    }

    /**
     * Error Handler to mute expected messages
     *
     * @link http://php.net/set_error_handler
     *
     * @param  integer $errno Error level
     * @param          $errstr
     * @param          $errfile
     * @param          $errline
     * @param          $errcontext
     *
     * @return boolean
     */
    public static function mutingErrorHandler($errno, $errstr, $errfile, $errline, $errcontext)
    {
        $_is_muted_directory = false;

        // add the SMARTY_DIR to the list of muted directories
        if (!isset(Smarty::$_muted_directories[SMARTY_DIR])) {
            $smarty_dir = realpath(SMARTY_DIR);
            if ($smarty_dir !== false) {
                Smarty::$_muted_directories[SMARTY_DIR] = array('file'   => $smarty_dir,
                                                                'length' => strlen($smarty_dir),);
            }
        }

        // walk the muted directories and test against $errfile
        foreach (Smarty::$_muted_directories as $key => &$dir) {
            if (!$dir) {
                // resolve directory and length for speedy comparisons
                $file = realpath($key);
                if ($file === false) {
                    // this directory does not exist, remove and skip it
                    unset(Smarty::$_muted_directories[$key]);
                    continue;
                }
                $dir = array('file' => $file, 'length' => strlen($file),);
            }
            if (!strncmp($errfile, $dir['file'], $dir['length'])) {
                $_is_muted_directory = true;
                break;
            }
        }

        // pass to next error handler if this error did not occur inside SMARTY_DIR
        // or the error was within smarty but masked to be ignored
        if (!$_is_muted_directory || ($errno && $errno & error_reporting())) {
            if (Smarty::$_previous_error_handler) {
                return call_user_func(Smarty::$_previous_error_handler, $errno, $errstr, $errfile, $errline, $errcontext);
            } else {
                return false;
            }
        }
    }

    /**
     * Enable error handler to mute expected messages
     *
     * @return void
     */
    public static function muteExpectedErrors()
    {
        /*
            error muting is done because some people implemented custom error_handlers using
            http://php.net/set_error_handler and for some reason did not understand the following paragraph:

                It is important to remember that the standard PHP error handler is completely bypassed for the
                error types specified by error_types unless the callback function returns FALSE.
                error_reporting() settings will have no effect and your error handler will be called regardless -
                however you are still able to read the current value of error_reporting and act appropriately.
                Of particular note is that this value will be 0 if the statement that caused the error was
                prepended by the @ error-control operator.

            Smarty deliberately uses @filemtime() over file_exists() and filemtime() in some places. Reasons include
                - @filemtime() is almost twice as fast as using an additional file_exists()
                - between file_exists() and filemtime() a possible race condition is opened,
                  which does not exist using the simple @filemtime() approach.
        */
        $error_handler = array('Smarty', 'mutingErrorHandler');
        $previous = set_error_handler($error_handler);

        // avoid dead loops
        if ($previous !== $error_handler) {
            Smarty::$_previous_error_handler = $previous;
        }
    }

    /**
     * Disable error handler muting expected messages
     *
     * @return void
     */
    public static function unmuteExpectedErrors()
    {
        restore_error_handler();
    }
}
