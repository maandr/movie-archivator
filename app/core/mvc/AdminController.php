<?php

abstract class AdminController extends Controller {

	const VIEW_PATH_LIST = "admin/%s/list.tpl";
	const VIEW_PATH_DETAILS = "admin/%s/details.tpl";
	const VIEW_PATH_CREATE = "admin/%s/create.tpl";
	const VIEW_PATH_EDIT = "admin/%s/edit.tpl";
	const PATH_HOME = "%s/show";

	protected $controllerHome;
	protected $controllerCreateView;
	protected $controllerEditView;
	protected $controllerListView;
	protected $controllerDetailsView;

	public function __construct($skipAuthorization = false) {
		parent::__construct();
		if(!$skipAuthorization)
		{
			$this->authorization();
		}

		$this->controllerHome = sprintf(self::PATH_HOME, $this->controllerName);
		$this->controllerCreateView = sprintf(self::VIEW_PATH_CREATE, $this->controllerName);
		$this->controllerEditView = sprintf(self::VIEW_PATH_EDIT, $this->controllerName);
		$this->controllerListView = sprintf(self::VIEW_PATH_LIST, $this->controllerName);
		$this->controllerDetailsView = sprintf(self::VIEW_PATH_DETAILS, $this->controllerName);
	}

	public function authorization() {
		$this->authorizeRole('owner');
		$this->authorizeRole('admin');
		$this->authorizeRole('moderator');

		$this->verifyAuthorization();
	}

	public function install() {
		return ($this->service == null)
			true :
			$this->service->install();
	}

	public function backup() {
		return ($this->service == null)
			true :
			$this->service->backup();
	}

	public function delete($id) {
		$this->service->delete($id);
		Location::redirectTo($this->controllerHome);
	}

	public function duplicate($id) {

		$this->service->duplicate($id);
		Location::redirectTo($this->controllerHome);
	}

	public function show($id = null) {

		if($id == null) {
			$viewModels = $this->service->getModels();
			$this->assign('Models', $viewModels);
			$this->render($this->controllerListView);
		}
		else
		{
			$viewModel = $this->service->getModel($id);
			$this->assign('Model', $viewModel);
			$this->render($this->controllerDetailsView);
		}
	}

	public function details($id) {
		$model = $this->service->getModel($id);
		$this->assign('Model', $model);
		$this->render($this->controllerDetailsView);
	}

  public function create() {
		if(isset($_POST))
		{
			$this->form->parse($_POST);
			$data = $this->form->getData();

			if($this->form->isValid())
			{
		    $this->service->create($data);
		    Location::redirectTo($this->controllerHome);
			}
			else
			{
				$model = $this->service->createModel($data);
				$this->assign('Model', $model);
				$this->render($this->controllerCreateView);
			}
		}
	}

	public function edit($id) {
		$model = $this->service->getModel($id);

		if(isset($_POST) && sizeof($_POST) > 0)
		{
			$this->form->parse($_POST);
			$data = $this->form->getData();

			if($this->form->isValid())
			{
				$data = $this->form->getData();
				$this->service->update($id, $data);
				Location::redirectTo($this->controllerHome);
			}
			else
			{
				$data['id'] = $id;
				$model = $this->service->createModel($data);
			}
		}

		$this->assign('Model', $model);
		$this->render($this->controllerEditView);
	}
}
?>
