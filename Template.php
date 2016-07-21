<?php 

class Template {
	private $pattern = ['{{', '}}'];
	private $templateContent;
	private $templateData;
	private $newContent;

	public function __construct($templateFile = '', array $data = []) {
		if (!empty($templateFile)) {
			$this->loadTemplate($templateFile);
		}
		$this->setData($data);
	}

	public function render($returnType = 'return') {
		$this->replaceContentWithData();

		if (trim(strtolower($returnType)) == 'return') {
			return $this->getNewContent();
		} elseif (trim(strtolower($returnType)) == 'echo') {
			echo $this->getNewContent();
		} else {
			throw new Exception("Wrong return type.");
		}
	}

	public function loadTemplate($templateFile) {
		$templateFile = trim($templateFile);
		if (file_exists($templateFile) && is_readable($templateFile)) {
			$this->setTemplateContent(file_get_contents($templateFile));
		} else {
			throw new Exception("Template file not found.");
		}
	}

	private function replaceContentWithData() {
		$content = $this->getTemplateContent();

		if (is_array($this->getData())) {
			foreach ($this->getData() as $key => $value) {
				$pattern = $this->pattern[0] . $key . $this->pattern[1];
		
				if (strpos($content, $pattern) !== false) {
					$content = str_replace($pattern, $value, $content);
				}
			}
		}

		$this->newContent = $content;
	}

	/* SETTERS */
	public function setData(array $data = []) {
		$this->templateData = $data;
	}

	private function setTemplateContent($content) {
		$this->templateContent = $content;
	}

	private function setNewContent($newContent) {
		$this->newContent = $newContent;
	}

	/* GETTERS */
	private function getData() {
		return $this->templateData;
	}

	private function getTemplateContent() {
		return $this->templateContent;
	}

	private function getNewContent() {
		return $this->newContent;
	}
}