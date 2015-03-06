<?php
require("zip.php");

class Export {
	protected $repo;
	protected $rev_hi;
	protected $rev_lo;
	protected $exported_files;
	protected $aux_path;
	protected $onthefly;
	protected $pathname;
	protected $debug;
	protected $changes;
	protected $summarize;
	protected $from_session = false;
	
	
	function __construct($repo, $rev_hi, $rev_lo = null, $proyect_name, $onthefly = true, $debug = false) {
		if (!$repo) {
			trigger_error("Repo needs to be specified!", E_USER_ERROR);
		}
		$this->repo = $repo;
		if (!$rev_hi) {
			trigger_error("Revision Hi needs to be specified!", E_USER_ERROR);
		}
		$this->rev_hi = $rev_hi;
		if (!$rev_lo) {
			if (!($rev_lo = $rev_hi-1) || $rev_lo == 0) {
				trigger_error("You have just one revision", E_USER_ERROR); 
			}
		}
		$this->rev_lo = $rev_lo;
		
		//Init the array
		$this->exported_files = array();
		
		$this->aux_path = $proyect_name;
		
		$this->onthefly = $onthefly;
		
		$this->debug = $debug;
		
		$this->pathname = dirname(dirname(__FILE__)) . "/{$this->aux_path}"; //Warning: Not change this path!
		
		//Set the changes to the object.
		$this->setChanges();
	}
	
	protected function svnExport($url, $path) {
		if (!@exec("svn export --force $url $path", $out)) {
			return $out;
		}
		return true;
	}
	
//Session functions
	function getSessionName() { 
		return  "{$this->aux_path}_{$this->rev_lo}_{$this->rev_hi}";
	}
	
	function setSession($data) {
		$session_name = $this->getSessionName();
		$_SESSION['export_portion'][$session_name] = $data;
	}
	
	function getSession() {
		$session_name = $this->getSessionName();
		return $_SESSION['export_portion'][$session_name];
	}
	
	function unsetSessionFile($file_name) {
		$session_name = $this->getSessionName();
		unset($_SESSION['export_portion'][$session_name][$file_name]);
	}
//End Session functions
	
	
	function setChanges() {
		
		//Check if there is something into the session.
		$session_files = $this->getSession();
		if($session_files && count($session_files) > 0) {
			
			$this->changes = $session_files;
			$this->from_session = true;
			
		} else if (exec("svn diff --summarize -r{$this->rev_lo}:{$this->rev_hi} {$this->repo}", $changes)) {
			
			$this->summarize = $changes;
			
			//Clean the url and deleted files.
			$changes = $this->export_clean_url($changes);
			
			//Save to session for posible crashs.
			$this->setSession($changes);
			
			//Save changes to object
			$this->changes = $changes;
			 
		} else {
			
			$this->changes = array();
			
		}
	}
	
	function export() {
		$changes = $this->changes;
		if($changes && count($changes) > 0) {

			//Echo texto.
			if($this->debug) {
				echo "Vamos a exportar ". count($changes) . " archivos! <br />";
			}
			
			//I prepare the auxiliar directory
			if (is_dir($this->pathname) || @mkdir($this->pathname)) {
				//Limpiamos la carpeta, en caso de que no venga por session.
				if(!$this->from_session) {
					@exec("rm -Rf " . $this->pathname . "/*", $out);
					
					//Save the changelog of modifications.
					$text_data = implode("\r\n", str_replace($this->repo, '', $this->summarize));
					file_put_contents($this->pathname."/ExportChangelog.txt", $text_data);
					
					//Check for deleted files
					if(isset($this->deleteFiles)) {
						$text_data = implode("\r\n", str_replace($this->repo, '', $this->deleteFiles));
						file_put_contents($this->pathname."/ExportDeleteThisFiles.txt", $text_data);
					}
				}
				
				//I do the checkouts
				foreach($changes as $index => $url) {
					$successful_exported_file = false;
					
					if(empty($url)) {
						continue;
					} 

					if($this->debug) {
						$url_reporte = str_replace($this->repo, '', $url);
						echo "Exportado hasta el momento [$index]: $url_reporte <br/>";
					}
					
					$path_svn = str_replace($this->repo, "", $url);
					$newpath = $this->pathname . $path_svn;
					if (!$this->svnExport($url, $newpath)){
						//Probablemente necesitemos crear las carpetas
						$folders_to_create = explode('/', $path_svn);
						if (!empty($folders_to_create)) {
							$old_path = "";
							foreach ($folders_to_create as $folder_name) {
								if (!strpos($folder_name, '.')) {
									$old_path .= "$folder_name/";
									if (!is_dir($this->pathname . $old_path)) {
										@mkdir($this->pathname . $old_path);
									}
								}
			  				}
						}
						if (!($return = $this->svnExport($url, $newpath))) {
							trigger_error("Problems. <br />" . implode('<br />', $return) , E_USER_ERROR);
						} else {
							$this->exported_files[] = $path_svn;
							$successful_exported_file = true;
						}
					} else {
						$this->exported_files[] = $path_svn;
						$successful_exported_file = true;
					}
					
					if($successful_exported_file) {
						//Remove from session.
						$this->unsetSessionFile($index);
					}
					
				}
				return true;
			}
			
		}
	}
	
	function showSummary() {
		if (!empty($this->exported_files)) {
			echo "
				<style>
					table, td {border: 1px solid gray; }
				</style>
			";
			echo "<table>";
			echo 	"<tr>";
			echo 		"<th>Files Exported</th>";
			echo 		"<th>Total</th>";
			echo 	"</tr>";
			echo 	"<tr>";
			echo 		"<td>" . implode("<br />", $this->exported_files) . "</td>";
			echo 		"<td>" . sizeof($this->exported_files) . " Files.</td>";
			echo 	"</tr>";
			echo "</table>";
		}
	}
	
	
	function zip() {
		//Create a zip file
	    $zip = new zipfile();
	    $pathtmp = dirname(dirname(__FILE__)) . "/tmp";
    	$f_name = $this->aux_path . ".zip";
    	
	    //Add the files to zip file
	    if (!empty($this->exported_files)) {
	    	foreach ($this->exported_files as $file_to_export_path) {
	    		if (file_exists($this->pathname . $file_to_export_path)) {
	    			if (is_dir($this->pathname . $file_to_export_path)) {
	    				$zip->add_dir($this->pathname . $file_to_export_path);
	    			} else {
		    			$zip->add_file($this->pathname . $file_to_export_path, substr($file_to_export_path, 1));
	    			}
		    	}
		    }
		    
		    
		    if ($this->onthefly) {
			    /*
				 * Zip Method 1: On the fly
				 * Problem: Just works with unzip command
				 */
				$filename = $f_name;
				$fd = fopen ($filename, "wb");
				$out = fwrite ($fd, $zip->file());
				fclose ($fd);
	
			    header("Content-type: application/octet-stream");
				header ("Content-disposition: attachment; filename={$f_name}");
				echo $zip->file();
				
		    } else {
				/*
				 * Zip Method 2: Build zip with zip unix command
				 * Problem: Add folder with zip name
				 */ 
		    	if (is_dir($pathtmp) || @mkdir($pathtmp)) {
			    	@exec("zip -r " . $pathtmp . "/{$f_name} {$this->aux_path}/*");
				    echo "<br />You can download the file <a href=\"tmp/$f_name\">here</a><br />";
			    }
				//Now remove de aux folder
				//@exec("rm -Rf " . $this->pathname, $out);
		    }
		}
	    
	}
	
	/**
	 * Esta funcion limpia la url. Tambien quita los archivo que fueron eliminados del svn.
	 * 
	 * @param array $url_array
	 * 
	 * @return arrray
	 */
	function export_clean_url($url_array) {
		$return_array = array();
		
		if(is_array($url_array)) {
			foreach($url_array as $index => $url) {
				//Sarch for svn status D of delete.
				$svn_status = trim(substr($url, 0, 3));
				$svn_url = trim(substr($url, 3));
	
				//If no ocurrence of D 'delete' add the file.
				if(strpos($svn_status, 'D') === FALSE) {
					if($svn_url) {
						$return_array[] = $svn_url;
					}
				} else {
					if(!isset($this->deleteFiles) || !is_array($this->deleteFiles)) {
						$this->deleteFiles = array();
					}
					
					$delete_url = str_replace($this->repo, '', $svn_url);
					$this->deleteFiles[] = $delete_url; 
				}
			}
		}
		
		return $return_array;
		//Extrac repo in url
		//$url = str_replace($this->repo, "", $url);
	}
}
