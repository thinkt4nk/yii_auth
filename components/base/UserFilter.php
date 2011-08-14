<?php
class UserFilter extends CFilter {
	
	protected $accessRules;
	
	/**
	 * Performs the pre-action filtering.
	 * @param CFilterChain the filter chain that the filter is on.
	 * @return boolean whether the filtering process should continue and the action
	 * should be executed.
	 */
	public function preFilter($filterChain)
	{
		$action = $filterChain->controller->getAction()->getId();
		if(@in_array($action, $this->accessRules['public'])) {
			return true;
		}
		if(@in_array($action, $this->accessRules['authenticated']) || @in_array($action, $this->accessRules['admin'])) {
			if(Yii::app()->user->isGuest) {
				$this->accessDenied(Yii::app()->user, "You need to be logged in.");
			}
			return true;
		}
		if(@in_array($action, $this->accessRules['admin'])) {
			if(!Yii::app()->user->isAdmin) {
				$this->accessDenied(Yii::app()->user, "You do not have access to this section.");
			}
			return true;
		}
		return true;
	}
	

	/**
	 * Denies the access of the user.
	 * This method is invoked when access check fails.
	 * @param IWebUser the current user
	 * @param string the error message to be displayed
	 * @since 1.0.5
	 */
	protected function accessDenied($user,$message)
	{
		if($user->getIsGuest())
			$user->loginRequired();
		else
			throw new CHttpException(403,$message);
	}
	
//	public function filter($filterChain)
//	{
//		if($this->preFilter($filterChain))
//		{
//			$filterChain->run();
//			$this->postFilter($filterChain);
//		}
//	}
	
	public function setRules($accessRules) {
		$this->accessRules = $accessRules;
	}
	
}
