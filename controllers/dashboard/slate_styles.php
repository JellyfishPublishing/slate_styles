<?php
defined('C5_EXECUTE') or die(_("Access Denied."));
/**
 *
 * @package concrete5-package-slate-styles
 * @author Ali Zandieh <www.ali-zandieh.com>
 **/
class DashboardSlateStylesController extends Controller {
    
    /**
     * Filename of the CSS file to be saved/created
     *
     * @access protected
     * @var string
     **/
    protected $_css_file;
    
    /**
     * Sets the _css_dir class var
     *
     * @access public
     * @return void
     **/
    public function on_start() {
        $this->_css_file = getenv('DOCUMENT_ROOT') . "/css/" . strtolower(DB_USERNAME) . "_slate.css";
    }
    
    /**
     * Reads the CSS file and pass it to the view as a variable
     *
     * @access public
     * @return void
     **/
    public function view() {

        if(!file_exists($this->_css_file)) {
            $default_file = DIR_PACKAGES . "/slate_styles/default_css.txt";
            if(!file_exists($default_file)) {
                $this->set('error', array('No default CSS could be found'));
                return;
            }
            $fh = fopen($default_file, 'rb');
            $css = fread($fh, filesize($default_file));
        }
        else {
            $fh = fopen($this->_css_file, 'r');

            $css = fread($fh, filesize($this->_css_file));
            fclose($fh);
        }        
        $this->set('css', $css);
        
        $h = Loader::helper('html');
        $this->addHeaderItem($h->javascript('codemirror.js', 'slate_styles'));
        $this->addHeaderItem($h->css('codemirror.css', 'slate_styles'));
        $this->addHeaderItem($h->javascript('css.js', 'slate_styles'));
        $this->addHeaderItem($h->css('default.css', 'slate_styles'));
        $this->addHeaderItem($h->javascript('creative.js', 'slate_styles'));
    }
    
    /**
     * Save the CSS passed from the view into the site specific CSS file
     *
     * @access public
     * @return void
     **/
    public function save() {
        
        $css = $_POST['css'];
		
        #chmod($this->_css_file, 0664);
		#chown($this->_css_file, 'apache');
		
		$command = 'sudo -i';
		exec($command, $output, $retval);
		#$output = chmod($this->_css_file,0664); 
        
		$fh = fopen($this->_css_file, 'w+b');
        fwrite($fh, $css);
        
        fclose($fh);
        
        $this->set('saved', true);
        $this->view();
    }
    
} 