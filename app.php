<?php

namespace PHPAnt\Themes;

/**
 * App Name: PHP Ant Material Design Theme
 * App Description: This app uses the Google Material Design as a Theme for PHP Ant
 * App Version: 1.0
 * App Action: cli-load-grammar   -> loadAntAppMaterialDesign @ 90
 * App Action: cli-init           -> declareMySelf            @ 50
 * App Action: cli-command        -> processCommand           @ 50
 * App Action: include-navigation -> includeNavigation        @ 50
 * App Action: show-dashboard     -> showDashboard            @ 50
 * App Action: include-footer     -> includeFooter            @ 50
 * App Action: get-site-name      -> getSiteName              @ 50
 */

 /**
 * This app adds the PHP Ant Material Design Theme and commands into the CLI by adding in
 * the grammar for commands into an array, and returning it up the chain.
 *
 * @package      PHPAnt
 * @subpackage   Themes
 * @category     Theme
 * @author       Michael Munger <michael@highpoweredhelp.com>
 */ 


class AntAppMaterialDesign extends \PHPAnt\Core\AntApp implements \PHPAnt\Core\AppInterface  {

    /**
     * Instantiates an instance of the AntAppMaterialDesign class.
     * Example:
     *
     * <code>
     * $appAntAppMaterialDesign = new AntAppMaterialDesign();
     * </code>
     *
     * @return void
     * @author Michael Munger <michael@highpoweredhelp.com>
     **/

    function __construct() {
        $this->appName = 'PHP Ant Material Design Theme';
        $this->canReload = true;
        $this->path = __DIR__;
    }

    /**
     * Callback for the cli-load-grammar action, which adds commands specific to this plugin to the CLI grammar.
     * Example:
     *
     * @return array An array of CLI grammar that will be merged with the rest of the grammar. 
     * @author Michael Munger <michael@highpoweredhelp.com>
     **/

    function loadAntAppMaterialDesign() {
        $grammar = [];

        $this->loaded = true;
        
        $results['grammar'] = $grammar;
        $results['success'] = true;
        return $results;
    }

    //Uncomment this function and the following function to enable the autoloader for this plugin.
    function AntAppMaterialDesignAutoLoader() {
        //REGISTER THE AUTOLOADER! This has to be done first thing! 
        spl_autoload_register(array($this,'loadAntAppMaterialDesignClasses'));
        return ['success' => true];

    }

    public function loadAntAppMaterialDesignClasses($class) {
        $baseDir = $this->path;

        $candidate_files = array();

        //Try to grab it from the classes directory.
        $candidate_path = sprintf($baseDir.'/classes/%s.class.php',$class);
        array_push($candidate_files, $candidate_path);

        //Loop through all candidate files, and attempt to load them all in the correct order (FIFO)
        foreach($candidate_files as $dependency) {
            if($this->verbosity > 14) printf("Looking to load %s",$dependency) . PHP_EOL;

            if(file_exists($dependency)) {
                if(is_readable($dependency)) {

                    //Print debug info if verbosity is greater than 9
                    if($this->verbosity > 9) print "Including: " . $dependency . PHP_EOL;

                    //Include the file!
                    include($dependency);
                }
            }
        }
        return ['success' => true];
    }
    
    /**
     * Callback function that prints to the CLI during cli-init to show this plugin has loaded.
     * Example:
     *
     * @return array An associative array declaring the status / success of the operation.
     * @author Michael Munger <michael@highpoweredhelp.com>
     **/

    function declareMySelf() {
        if($this->verbosity > 4 && $this->loaded ) print("PHP Ant Material Design Theme app loaded.\n");

        return ['success' => true];
    }

    function processCommand($args) {
        $cmd = $args['command'];

        return ['success' => true];
    }

    function includeNavigation($args) {
        $Engine = $args['AE'];

        include(__DIR__ . '/resources/header.php');
        return ['success' => true];
    }

    function showDashboard($args) {
        //include(__DIR__ . '/resources/dashboard.php');
        return ['success' => true];
    }

    function includeFooter($args) {
        include(__DIR__ . '/resources/footer.php');
        return ['success' => true];
    }

    function getSiteName($args) {
        $sitename = $args['AE']->Configs->getConfigs(['sitename'])['sitename'];
        echo $sitename;
        return ['success' => true];
    }    
}