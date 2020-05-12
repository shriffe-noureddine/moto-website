@extends('template.mytemplate')

@section('links')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
@endsection


@section('style')
<style>
      select {
            height: 7rem;
            width: 15rem;
      }

      button {
            display: block;
            margin: 15px;
      }

     

      #SearchNFilter{
            padding: 15px;
            display: flex;
            justify-content: space-between;
      }


      @media screen and (min-width: 375px) {
            section {
                  display: flex;
                  justify-content: space-between;
                  
            }
            #first-div{
                  margin-right: 2rem;
            }
           

            #filterButtons {
                  
                  margin-top: 5rem;
            }

      }
</style>
@endsection

@section('title', 'Gallery List')


@section('content')

<header id="filterHeader">


      <section id="SearchNFilter" class="row ">

            <div class="filter-div" id="first-div">
                  <h3>users</h3>
                  <div><select name="usersSelect" id="usersSelect" MULTIPLE></select>
                  </div>
            </div>
            <div class="filter-div">
                  <h3>brands</h3>
                  <div><select name="brandsSelect" id="brandsSelect" MULTIPLE></select>
                  </div>
            </div>

            <div class="filter-div">
                  <h3>models</h3>
                  <div><select name="modelsSelect" id="modelsSelect" MULTIPLE></select>
                  </div>
            </div>


            <div class="filter-div">
                  <h3>colors</h3>
                  <div><select name="colorsSelect" id="colorsSelect" MULTIPLE></select>
                  </div>
            </div>

            <div class="filter-div">
                  <h3>construction</h3>
                  <div><select name="constructionDatesSelect" id="constructionDatesSelect" MULTIPLE></select>
                  </div>
            </div>


            <div class="filter-div" style="text-align:center;margin:2rem;">

                  <div id="filterButtons" style="display:flex;justify-content:center;">
                        <button class="btn btn-warning" id="clearFilters">clear Filters</button>
                        <button class="btn btn-success" id="applyFilters">apply Filters</button>
                  </div>
            </div>
      </section>
      <div id="toggleFilters" class="container">
            <div id="toggleFiltersButton" style="text-align:center;margin:2rem;">
                  <input type="checkbox" checked data-toggle="toggle">
            </div>
      </div>
</header>


<div id="searchDiv" class="form-inline" style="display:flex;justify-content:center;">
      <div id="searchNote">&nbsp;</div>
      <i id="applySearch" class="fa fa-search" aria-hidden="true"></i>
      <input id="searchInput" class="form-control form-control-sm ml-3 w-75" type="text" placeholder="Search for brand or model" aria-label="Search">

</div>
{{-- <div id="searchDiv" style="text-align:center">
                 <div id="searchNote">&nbsp;</div>
                 <input id="searchInput" class="form-control" type="text" placeholder="Search" aria-label="Search">
      
                 <button id="applySearch"> Search</button>
           </div>  --}}


<section id="pagination" style="display: flex; justify-content: center;">
      <ul class="pagination justify-content-end">
            <li class="page-item">
                  <a class="page-link" id="paginationLower" href="#" tabindex="-1">Previous</a>
            </li>

            <li class="page-item disabled"><span id="pagingNumber">x</span></li>
            <li class="page-item disabled"> <span id="motoCount">###</span> </li>

            <li class="page-item">
                  <a id="paginationHigher" class="page-link" href="#">Next</a>
            </li>
      </ul>
</section>


{{-- <section id="pagination">
      <ul style="display:flex;justify-content:center;list-style:none;font-weight:bold;">
            <li><a href="#" id="paginationLower">&lt;&lt;&lt;</a></li>

            <li>&nbsp;&nbsp;&nbsp;--- <span id="pagingNumber">x</span> ---&nbsp;&nbsp;&nbsp;
            [<span id="motoCount">###</span>] motos found&nbsp;&nbsp;&nbsp;</li>

            <li><a href="#" id="paginationHigher">&gt;&gt;&gt;</a></li>
      </ul>
</section>  --}}




<div id="filledByJS" style="min-height: 90vh;">
      ... content loading ...
</div>






<script>
      // loading content into the page
      // look at these two wonderful readings into javascript array
      //const motors = {!! json_encode($motors) !!};
      let allMotors = @json($motors);
      let allUsers = [];
      for (const [i, user] of Object.entries(@json($users))) {
            allUsers[user.id] = user.name;
      }
      let currentSection;
      let users = [];
      let brands = [];
      let models = [];
      let colors = [];
      let constructionDates = [];
      let pages = [];
      const itemsPerPage = 7;
      let currentPage = 0;
      let maxPage;
      let motors = [];
      displayPages(allMotors);

      function displayPages(motors) {
            motors = sortByCreated(motors);
            pages = [];
            pagination(itemsPerPage, pages, motors);
            pages.shift(); // workaround: why is the first element empty?                     
            currentPage = 0;
            maxPage = pages.length;
            $('#motoCount').html('' + motors.length);
            $('#filledByJS').html('');
            pageUpDown(1); // calling the page to display
      }

      function sortByCreated(motors) {
            return motors.sort((a, b) => (a.created_at < b.created_at) ? 1 : -1);
      }

      // sorting the filter contents
      users.sort();
      brands.sort();
      models.sort();
      colors.sort();
      constructionDates.sort();
      constructionDates.reverse();
      // filling filter elements
      $.each(users, function(i, user) {
            $('#usersSelect').append($('<option></option>').val(user).html(user));
      });
      $.each(brands, function(i, brand) {
            $('#brandsSelect').append($('<option></option>').val(brand).html(brand));
      });
      $.each(models, function(i, model) {
            $('#modelsSelect').append($('<option></option>').val(model).html(model));
      });
      $.each(colors, function(i, color) {
            $('#colorsSelect').append($('<option></option>').val(color).html(color));
      });
      $.each(constructionDates, function(i, constructionDate) {
            $('#constructionDatesSelect').append($('<option></option>').val(constructionDate).html(constructionDate));
      });

      // apply Filters
      $('#applyFilters').click(function applyFilters() {
            // get selected values        
            let selUsers = $('#usersSelect').val();
            let selBrands = $('#brandsSelect').val();
            let selModels = $('#modelsSelect').val();
            let selColors = $('#colorsSelect').val();
            let selYears = $('#constructionDatesSelect').val();
            if (selYears) selYears = selYears.map(Number); // is string, needs to be number            
            if (!selUsers && !selBrands && !selModels && !selColors && !selYears) {
                  return
            }; // no filter selected
            let newMotors = [];
            for (const [i, motor] of Object.entries(allMotors)) {
                  if (selUsers) {
                        if (!(selUsers.indexOf(allUsers[motor.user_id]) >= 0)) continue;
                  }
                  if (selBrands) {
                        if (!(selBrands.indexOf(motor.brand) >= 0)) continue;
                  }
                  if (selModels)
                        if (!(selModels.indexOf(motor.model) >= 0)) {
                              continue;
                        }
                  if (selYears)
                        if (!(selYears.indexOf(motor.constructionDate) >= 0)) {
                              continue;
                        }
                  if (selColors)
                        if (!(selColors.indexOf(motor.color) >= 0)) {
                              continue;
                        }
                  newMotors.push(motor);
            }
            displayPages(newMotors);
      });

      // clear Filters      
      $('#clearFilters').click(function clearFilters() {
            // get selected values              
            $('#usersSelect option:selected').prop("selected", false);
            $('#brandsSelect option:selected').prop("selected", false);
            $('#modelsSelect option:selected').prop("selected", false);
            $('#colorsSelect option:selected').prop("selected", false);
            $('#constructionDatesSelect option:selected').prop("selected", false);
            displayPages(allMotors);
      });

      // apply Search
      $('#searchInput').keyup(function(event) {
            if (event.keyCode === 13) {
                  // console.log('olaf');
                  document.getElementById("applySearch").click();
            }
      });

      $('#applySearch').click(function search() {
            // get selected values        
            let searchTerm = $('#searchInput').val();
            if (searchTerm.length == 0) {
                  $('#clearFilters').click();
                  $("#searchNote").html("&nbsp;");
                  $("#searchNote").css("border", "none");
                  return;
            }
            if (searchTerm.length < 3) {
                  $("#searchNote").html("<h4>!! at least 3 characters</h4>");
                  $("#searchNote").css("color", "red");
                  return;
            } else {
                  $("#searchNote").html("&nbsp;");
                  $("#searchNote").css("border", "none");
            }

            let newMotors = [];
            let pattern = new RegExp(searchTerm);
            for (const [i, motor] of Object.entries(allMotors)) {
                  if (res = pattern.exec(motor.brand)) {
                        newMotors.push(motor);
                        continue;
                  }
                  if (res = pattern.exec(motor.model)) {
                        newMotors.push(motor);
                        continue;
                  }
            }
            displayPages(newMotors);
      });






      // var input = document.getElementById("searchInput");
      // input.addEventListener("keyup", function(event) {
      //   if (event.keyCode === 13) {
      //    event.preventDefault();
      //    document.getElementById("applySearch").click();
      //   }
      // });





      // toggle Filter Section
      window.hideFilters = false;
      $('#toggleFiltersButton').click(function toggle() {
            window.hideFilters = !window.hideFilters;
            window.hideFilters ? $('#SearchNFilter').hide() : $('#SearchNFilter').show();
      });

      // create the pagination chunks into pages variable
      function pagination(itemsPerPage, pages, motors) {
            let articles = [];
            let articlescount = 0;
            for (const [i, motor] of Object.entries(motors)) {
                  currentSection = '\
                  <section >\
                  <div class="container py-3 ">\
                  <div class="card"  >\
                  <div class="row " style="background-color: #999999; padding: 10px; border: 2px solid green; border-radius: 25px; ">\
                  <div class="col-md-4" >\
                  <img style="display: block; width: auto; height: 120px;" src="' + motor.thumbnail + '">\
                  </div>\
                  <div class="col-md-8 px-3">\
                  <div class="card-block px-3">\
                  <div style="display: flex; justify-content: space-between">\
                  <h4 class="card-title">' + motor.brand + ' (' + motor.model + ')</h4>\
                  <h4>Construction year: ' + motor.constructionDate + '</h4>\
                  <h4>Price: ' + motor.price + ' $</h4>\
                  </div>\
                  <div class="card-body" style="white-space: nowrap; overflow: hidden; text-overflow: clip; ">\
            <p class="card-text card-text lead" style="height: 30px;">' + motor.description + '</p>\
                  </div >\
                  <div style="display: flex; justify-content: space-between">\
                  <span>Model: ' + motor.model + '</span>\
                  <span>Published on: ' + motor.created_at + '</span><br>\
                  <a href="/motors/' + motor.id + '" class="btn btn-success">Read More</a>\
                  </div>\
                  </div>\
                  </div>\
                  </div>\
                  </div>\
                  </div>\
                  </section>\
                  ';
                  // filling filter arrays
                  username = allUsers[motor.user_id]
                  if (users.indexOf(username) < 0) {
                        users.push(username);
                  }
                  if (brands.indexOf(motor.brand) < 0) {
                        brands.push(motor.brand);
                  }
                  if (models.indexOf(motor.model) < 0) {
                        models.push(motor.model);
                  }
                  if (colors.indexOf(motor.color) < 0) {
                        colors.push(motor.color);
                  }
                  if (constructionDates.indexOf(motor.constructionDate) < 0) {
                        constructionDates.push(motor.constructionDate);
                  }
                  if (articlescount % itemsPerPage == 0) {
                        pages.push(articles);
                        articles = [];
                  }
                  articles.push(currentSection);
                  articlescount++;
            }
            if (articles.length > 0) pages.push(articles);
      }

      // add event listeners to pagination links
      $("#paginationHigher").click(function() {
            pageUpDown(1);
      });

      $("#paginationLower").click(function() {
            pageUpDown(0);
      });

      function pageUpDown(up) {
            up ? currentPage++ : currentPage--;
            if (currentPage < 1) currentPage = 1;
            if (currentPage > maxPage) currentPage = maxPage;
            $('#pagingNumber').html("" + currentPage + " of " + maxPage);
            $('#filledByJS').html('');
            $('#filledByJS').append(pages[currentPage - 1]);
      }
</script>




@endsection