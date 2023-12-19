

<div class="col-md-10 col-sm-9 lodingbefor" ng-app="firstapp" ng-controller="Index" style="display: none;">
	
<div class="panel panel-default">
	<div class="panel-body">
		

<font size="4"><span class="glyphicon glyphicon-th" aria-hidden="true"></span>
<?=$lang_cussex?>  <a class="btn btn-primary"  style="float: right" ng-click="Openaddnewcus()"><span class="glyphicon glyphicon-plus" aria-hidden="true"></a></font>

<hr />



<div class="col-md-12 text-right">
<input type="checkbox" ng-model="Showdelbut"> <?=$lang_showdel?> 
</div>




<br />
<table class="table table-hover">
	<thead>
		<tr style="background-color: #eee">
			
			<th><?=$lang_cussex?> </th>
			<th><?=$lang_remark?> </th>
			
			<th><?=$lang_manage?> </th>
		</tr>
	</thead>
	<tbody>




		<tr ng-repeat="x in customergroup">
			



			<td>{{x.customer_sex_name}}</td>
			<td>{{x.customer_sex_remark}}</td>
			<td width="70px">
<button class="btn btn-warning btn-xs" ng-click="Editrow(x)"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></button>
<button ng-if="Showdelbut" class="btn btn-danger btn-xs" id="deletecustomer" ng-click="Delete(x.customer_sex_id)"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></button>
			</td>
		</tr>

	</tbody>
</table>


	</div>
</div>






<div class="modal fade" id="modal-id">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><?=$lang_addnewsex?> </h4>
			</div>
			<div class="modal-body">


<div class="row">
<div class="col-md-12">
	<input type="text" placeholder="<?=$lang_cussex?> " name="" class="form-control" ng-model="customer_sex_name" required>

</div>


	<div class="col-md-12">
	<br />
</div>	

<div class="col-md-12">
	<textarea name="" class="form-control" placeholder="<?=$lang_remark?> " ng-model="customer_sex_remark">
</textarea> 
</div>

				

		</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">close</button>
<button type="submit" class="btn btn-success" id="savenewcustomer" ng-click="SaveSubmit(customer_sex_name,customer_sex_remark)"><?=$lang_save?> </button>
			</div>
		</div>



	</div>
</div>







<div class="modal fade" id="modaledit">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title"><?=$lang_editsex?> </h4>
			</div>
			<div class="modal-body">


<div class="row">
<div class="col-md-12">
	<input type="text" placeholder="<?=$lang_cussex?> " name="" class="form-control" ng-model="customer_sex_name" required>

</div>


	<div class="col-md-12">
	<br />
</div>	

<div class="col-md-12">
	<textarea name="" class="form-control" placeholder="<?=$lang_remark?> " ng-model="customer_sex_remark">
</textarea> 
</div>


				

		</div>

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">close</button>
<button type="submit" class="btn btn-success" id="editcustomer" ng-click="EditSubmit(customer_sex_id,customer_sex_name,customer_sex_remark)"><?=$lang_save?> </button>
			</div>
		</div>



	</div>
</div>






</div>




<script>
var app = angular.module('firstapp', []);
app.controller('Index', function($scope,$http,$location) {


$scope.getcustomer = function(){
   
$http.get('Customersex/get')
       .then(function(response){
          $scope.customergroup = response.data.list; 
                 
        });
       $('.lodingbefor').css('display','block');

   };
$scope.getcustomer();


$scope.Openaddnewcus = function(){
	$('#modal-id').modal('show');
	$scope.customer_sex_name = '';
$scope.customer_sex_remark ='';

};


$scope.SaveSubmit = function(customer_sex_name,customer_sex_remark){
	
	

$("#savenewcustomer").prop("disabled",true);
$http.post("Customersex/add",{
	'customer_sex_name': customer_sex_name,
	'customer_sex_remark': customer_sex_remark,
	}).success(function(data){
toastr.success('<?=$lang_success?> ');
$("#savenewcustomer").prop("disabled",false);

	$scope.customer_sex_name = '';
$scope.customer_sex_remark ='';

$('#modal-id').modal('hide');
$scope.getcustomer();



        });	
	
	
};





$scope.Delete = function(customer_sex_id){
	

$http.post("Customersex/delete",{
	'customer_sex_id': customer_sex_id
	}).success(function(data){
toastr.success('<?=$lang_success?>');
$scope.getcustomer();



        });	
	
	
};


$scope.Editrow = function(x){
$('#modaledit').modal('show');
$scope.customer_sex_id = x.customer_sex_id;
$scope.customer_sex_name = x.customer_sex_name;
$scope.customer_sex_remark = x.customer_sex_remark;


};



$scope.EditSubmit = function(customer_sex_id,customer_sex_name,customer_sex_remark){
	
	

$("#editcustomer").prop("disabled",true);
$http.post("Customersex/update",{
	'customer_sex_id': customer_sex_id,
	'customer_sex_name': customer_sex_name,
	'customer_sex_remark': customer_sex_remark,
	}).success(function(data){
toastr.success('<?=$lang_success?>');
$("#editcustomer").prop("disabled",false);

	$scope.customer_sex_name = '';
$scope.customer_sex_remark ='';

$('#modaledit').modal('hide');
$scope.getcustomer();



        });	
	
	
};






});
	</script>