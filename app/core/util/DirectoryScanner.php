<?php
class DirectoryScanner
{
	private $directory;
	private $fileExtension;
	
	public function __construct($directory, $fileExtension = null)
	{
		$this->setDirectory($directory);
		$this->setFileExtension($fileExtension);
		
	}
	
	public function setDirectory($directory)
	{
		$this->directory = $directory;
	}
	
	public function setFileExtension($fileExtension)
	{
		$this->fileExtension = $fileExtension;
	}
	
	public function getFiles()
	{
		return $this->getFilesFromDirectory($this->directory, false);
	}
	
	public function getFilesRecursive()
	{
		return $this->getFilesFromDirectory($this->directory, true);
	}
	
	private function getFilesFromDirectory($directory, $recursive = true)
	{
		$folderFiles = array();
		
		$filesAndDirectories = scandir($directory);

		foreach($filesAndDirectories as $fileOrDirectory)
		{
			if(!$this->isFileOrDirectory($fileOrDirectory))
			{
				continue;
			}
			
			$fileOrDirectoryPath = $directory.$fileOrDirectory;
			
			if($this->isDirectory($fileOrDirectoryPath) && $recursive)
			{
				$subDirFiles = $this->getFilesFromDirectory($fileOrDirectoryPath, true);
				$folderFiles = array_merge($folderFiles, $subDirFiles);
			}
			else
			{
				$filePath = pathinfo($fileOrDirectoryPath);
				array_push($folderFiles, $filePath['basename']);
			}
		}
		
		return $folderFiles;
	}
	
	private function isFileOrDirectory($path)
	{
		return $path != '.' && $path != '..';
	}
	
	private function isDirectory($path)
	{
		return is_dir($path);
	}
}
?>