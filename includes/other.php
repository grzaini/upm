

<?php require_once("Header.php"); ?>

		<link rel="stylesheet" href="inc/persian-datepicker.css"/>

			<script src="inc/persian-date.js"></script>
			<script src="inc/persian-datepicker-0.4.5.js"></script>


	          <script type="text/javascript">
			$(document).ready(function() {
					$(".new").pDatepicker({
					format : "YYYY-MM-DD"
				});
			});
		</script>



			<script src="search/jquery-ui.js"></script>





	<script>

	$( function() {
		$.widget( "custom.combobox", {
			_create: function() {
				this.wrapper = $( "<span>" )
					.addClass( "custom-combobox" )
					.insertAfter( this.element );

				this.element.hide();
				this._createAutocomplete();
				this._createShowAllButton();
			},

			_createAutocomplete: function() {
				var selected = this.element.children( ":selected" ),
					value = selected.val() ? selected.text() : "";

				this.input = $( "<input>" )
					.appendTo( this.wrapper )
					.val( value )
					.attr( "title", "" )
					.addClass( "custom-combobox-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
					.autocomplete({
						delay: 0,
						minLength: 0,
						source: $.proxy( this, "_source" )
					})
					.tooltip({
						classes: {
							"ui-tooltip": "ui-state-highlight"
						}
					});

				this._on( this.input, {
					autocompleteselect: function( event, ui ) {
						ui.item.option.selected = true;
						this._trigger( "select", event, {
							item: ui.item.option
						});
					},

					autocompletechange: "_removeIfInvalid"
				});
			},

			_createShowAllButton: function() {
				var input = this.input,
					wasOpen = false;

				$( "<a>" )
					.attr( "tabIndex", -1 )
					.attr( "title", "Show All Items" )
					.tooltip()
					.appendTo( this.wrapper )
					.button({
						icons: {
							primary: "ui-icon-triangle-1-s"
						},
						text: false
					})
					.removeClass( "ui-corner-all" )
					.addClass( "custom-combobox-toggle ui-corner-right" )
					.on( "mousedown", function() {
						wasOpen = input.autocomplete( "widget" ).is( ":visible" );
					})
					.on( "click", function() {
						input.trigger( "focus" );

						// Close if already visible
						if ( wasOpen ) {
							return;
						}

						// Pass empty string as value to search for, displaying all results
						input.autocomplete( "search", "" );
					});
			},

			_source: function( request, response ) {
				var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
				response( this.element.children( "option" ).map(function() {
					var text = $( this ).text();
					if ( this.value && ( !request.term || matcher.test(text) ) )
						return {
							label: text,
							value: text,
							option: this
						};
				}) );
			},

			_removeIfInvalid: function( event, ui ) {

				// Selected an item, nothing to do
				if ( ui.item ) {
					return;
				}

				// Search for a match (case-insensitive)
				var value = this.input.val(),
					valueLowerCase = value.toLowerCase(),
					valid = false;
				this.element.children( "option" ).each(function() {
					if ( $( this ).text().toLowerCase() === valueLowerCase ) {
						this.selected = valid = true;
						return false;
					}
				});

				// Found a match, nothing to do
				if ( valid ) {
					return;
				}

				// Remove invalid value
				this.input
					.val( "" )
					.attr( "title", value + " didn't match any item" )
					.tooltip( "open" );
				this.element.val( "" );
				this._delay(function() {
					this.input.tooltip( "close" ).attr( "title", "" );
				}, 2500 );
				this.input.autocomplete( "instance" ).term = "";
			},

			_destroy: function() {
				this.wrapper.remove();
				this.element.show();
			}
		});

		$( ".combobox" ).combobox();
		$( "#toggle" ).on( "click", function() {
			$( ".combobox" ).toggle();
		});
	} );
	</script>


	<div class = "row col-md-12 mx-auto">
	<legend class="col-md-3 col-form-label pt-0 float-right text-right"></legend>

		<div class = "panel panel-primary row col-md-7 mx-auto">
			<div class  = "panel-heading">
					<h4>صفحه فروشات برای مشتریان</h4>
			</div>
			<div class = "panel-body">
			   <form>

<div class  = "col-lg-5 col-sm-6 pull-right"style  = "text-align:right;">

		<label for="title" class="col-form-label-sm float-right"><span class="text-danger">*</span>اسم مکمل مشتری</label>
              <span></span>
			  <div class="">

	<select id="combobox" class = "combobox col-form-label-sm text-right">
		<option value="">Select one...</option>
		<option value="ActionScript">ActionScript</option>
		<option value="AppleScript">AppleScript</option>
		<option value="Asp">Asp</option>
		<option value="BASIC">BASIC</option>
		<option value="C">C</option>
		<option value="C++">C++</option>
		<option value="Clojure">Clojure</option>
		<option value="COBOL">COBOL</option>
		<option value="ColdFusion">ColdFusion</option>
		<option value="Erlang">Erlang</option>
		<option value="Fortran">Fortran</option>
		<option value="Groovy">Groovy</option>
		<option value="Haskell">Haskell</option>
		<option value="Java">Java</option>
		<option value="JavaScript">JavaScript</option>
		<option value="Lisp">Lisp</option>
		<option value="Perl">Perl</option>
		<option value="PHP">PHP</option>
		<option value="Python">Python</option>
		<option value="Ruby">Ruby</option>
		<option value="Scala">Scala</option>
		<option value="Scheme">Scheme</option>
	</select>
</div>

	<label for="title" class="col-form-label-sm float-right"><span class="text-danger">*</span>اسم مکمل مشتری</label>
	<div></div>

	                    <div class="">


	<select class = "combobox text-right">
		<option value="">Select one...</option>
		<option value="ActionScript">ActionScript</option>
		<option value="AppleScript">AppleScript</option>
		<option value="Asp">Asp</option>
		<option value="BASIC">BASIC</option>
		<option value="C">C</option>
		<option value="C++">C++</option>
		<option value="Clojure">Clojure</option>
		<option value="COBOL">COBOL</option>
		<option value="ColdFusion">ColdFusion</option>
		<option value="Erlang">Erlang</option>
		<option value="Fortran">Fortran</option>
		<option value="Groovy">Groovy</option>
		<option value="Haskell">Haskell</option>
		<option value="Java">Java</option>
		<option value="JavaScript">JavaScript</option>
		<option value="Lisp">Lisp</option>
		<option value="Perl">Perl</option>
		<option value="PHP">PHP</option>
		<option value="Python">Python</option>
		<option value="Ruby">Ruby</option>
		<option value="Scala">Scala</option>
		<option value="Scheme">Scheme</option>
	</select>

	</div>
</div>


				<div style  = "margin:0 auto" class  = "col-lg-4 col-sm-6 pull-right">
				     <div class="form-group">
                    <label for="title" class="col-form-label-sm float-right"><span class="text-danger">*</span>مقدار قابل پرداخت</label>
                    <input type="number" class="form-control text-right" id="title_fa" name="amount" value="">
					</div>

				   <div class="form-group">
                    <label for="title" class="col-form-label-sm float-right"><span class="text-danger">*</span>تاریخ پرداخت معاش</label>

		<input type="text" class="new form-control text-right" />
				  </div>

				  </div>
				  <div class  = "col-lg-3 col-sm-12">
				  <div class="form-group">
				  <input type="submit" class="btn btn-primary col-form-label-sm form-control" id="submit" name="addnew">
				  </div>
				  </div>

				 </form>
			</div>
			<div class  = "panel-footer">

	<h3 class="text-center">لیست اجناس در حال فروش</h3>

	<br>
  <div class="table-responsive">
    <table id="lecturers_table" class="table table-striped table-bordered nowrap" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th class="text-center">بیشتر</th>
                <th class="text-center">پاک کردن</th>
                <th class="text-center">تاریخ</th>
                <th style  = "width:40px" class="text-center">مقدار </th>
               <th style  = "width:40px" class="text-center">اسم کارمند</th>
                <th class="text-center">شماره</th>
            </tr>
        </thead>
        <tbody>

          <tr>
            <td style  = "width:30px" ><button class="btn btn-sm" onclick="detailsmodal(id)"></button></td>
            <td style  = "width:30px"><a href = "StudentEdit.php?Student_id="><span class = "glyphicon glyphicon-trash" style = "color:red;"></span></a></td>
			<td style  = "width:40px" class="text-right">2019/12/02</td>
            <td style  = "width:40px" class="text-right">1398/10/05</td>

            <td  class="text-right">خبر جدید</td>
            <td style  = "width:30px" >1</td>
          </tr>
        </tbody>
    </table>
  </div>

<script>
  $(document).ready(function() {
    $("#lecturers_table").DataTable(
      {
        //"autoWidth": false,
        "lengthMenu": [[15,30,45,60,-1],[15,30,45,60,"All"]],
        "ordering": true,
        stateSave: true,
        "language": {
          "info": "نشان دهنده از _START_ تا _END_ ازمجموعه _TOTAL_ رکود",
          "search": "جستجو",
          "lengthMenu": "تعداد _MENU_ نشان داده شده است |"
        },
        scrollX:        true,
        scrollCollapse: true,
        autoWidth:         true,
        columnDefs: [
        { "width": "30px", "targets": [0] },
        { "width": "40px", "targets": [4] }
        ]
      }
    );
  });
</script>


			</div>
		</div>
	</div>

	<link rel="stylesheet" href="search/jquery_ui.css">
	<link rel="stylesheet" href="search/style.css">

	<style>
	.custom-combobox {
		position: relative;
		display: inline-block;
	}
	.custom-combobox-toggle {
		position: absolute;
		top: 0;
		bottom: 0;
		margin-left: -1px;
		padding: 0;
	}
	.custom-combobox-input {
		margin: 0;
		padding: 5px 10px;
	}
	</style>





<?php require_once("Footer.php"); ?>
