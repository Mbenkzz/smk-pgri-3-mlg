<div class="d-flex flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
	<h1 class="h2">Sosial Media</h1>
	<!-- <div class="btn-toolbar mb-2 mb-md-0 ml-2">
		<div class="btn-group mr-2">
			<a class="btn btn-sm btn-outline-success disabled" href="<?= BASE_URL ?>admin-ea/sosmed/add" disabled>Add Sosmed</a>
			<button type="button" class="btn btn-sm btn-outline-secondary" disabled>Export</button>
		</div>
	</div> -->
	<div class="form-group search">
		<input type="text" class="form-control form-control-sm" id="searchSosmed" onkeyup="render()" placeholder="Search...">
	</div>
</div>
<div class="row">
	<div class="col-xl-3 col-sm-6 col-9">
		<div class="input-group mb-3 input-group-sm">
			<div class="input-group-prepend">
				<span class="input-group-text">Records per page</span>
			</div>
			<select class="form-control" id="record_per_page" onchange="render()">
				<option value="5">5</option>
				<option value="10" selected>10</option>
				<option value="25">25</option>
				<option value="50">50</option>
			</select>
		</div>
	</div>
</div>
<div class="table-responsive">
	<table class="table table-striped table-sm" id="table_sosmed">
		<thead>
			<tr>
				<th>No<span></span></th>
				<th width="25%" onclick="sort_column(this, 'sosmed_platform')">Platform<span><i class="fa fa-sort"></i></span></th>
				<th width="25%">Akun</th>
				<th>Terakhir Di ubah</th>
				<!--<th width="15%">Status<span></span></th>-->
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody></tbody>
	</table>
	<ul class="pagination justify-content-end" id="pagination_sosmed" style="margin:20px 0"></ul>
</div>
<script type="text/javascript">
	var order = "";
	var direction = "ASC";
	$(document).ready(function() {
		render();
	});

	function sort_column(that, column) {
		var span = $('th').children('span');
		var $span = $(that).children('span');
		var order = column;
		if ($span.children('i').hasClass('fa-sort')) {
			span.children('i').removeClass('fa-sort-asc');
			span.children('i').removeClass('fa-sort-desc')
			span.children('i').addClass('fa-sort');
			$span.children('i').removeClass('fa-sort');
			$span.children('i').addClass('fa-sort-asc');
			direction = "ASC";
		} else if ($span.children('i').hasClass('fa-sort-asc')) {
			$span.children('i').removeClass('fa-sort-asc');
			$span.children('i').addClass('fa-sort-desc'); 
			direction = "DESC";
		} else {
			$span.children('i').removeClass('fa-sort-desc');
			$span.children('i').addClass('fa-sort-asc'); 
			direction = "ASC";
		}
		render(true, `${column} ${direction}`);
	}

	function render(page = 1, sort = "") {
		if (sort != "") {
			if(order != sort) {
				order = sort;
				direction = "ASC";
			}
		}
		if (page === true) {
			page = $(".page-item.active").attr('data-page');
		}
		$.ajax({
			url: '<?= BASE_URL ?>admin-ea/sosmed/table',
			type: "get",
			data: {
				search: $("#searchSosmed").val(),
				page: page,
				per_page: $("#record_per_page").val(),
				order_by: order
			},
			success: function(response) {
				var response = eval('(' + response + ')');
				var $tbody = $("#table_sosmed").find('tbody');
				var $pagination = $("#pagination_sosmed");
				$tbody.html("");
				$tbody.html(response.CONTENT);
				$pagination.html("");
				$pagination.html(response.PAGINATION);
			}
		});
	}
</script>