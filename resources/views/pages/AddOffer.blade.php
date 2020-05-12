@extends('template.mytemplate')
@section('style')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<style>
.normalLabels {
  font-weight:900;
  font-size:2rem;
  margin: 0;
  padding:0;
}
</style>
@endsection

@section('title', 'New Offer')

@section('content')
<br>
<div style="display: flex; justify-content: center; min-height:90vh;">
  <div class="card">
    <img class=" d-block" src="/profile-image/interface.jpg" alt="Card image cap">
    <div class="card-body">
      <div>


        <h2 style="color: green" class="card-text">Fill the following information about your offer </h2>
       
      </div>

      <div>
        <form action="/offer" enctype="multipart/form-data" method="POST">
          @csrf
         <span class="normalLabels">Detail Picture:</span>
          <div class="custom-file" style="margin: 10px 0;">
            <input type="hidden" name="MAX_FILE_SIZE" value="10240000" />
            <input name="picture" type="file" value="browse" class="@error('picture') is-invalid @enderror custom-file-input" id="customFile" />
            <label class="custom-file-label" for="customFile">Choose file</label>
          </div>

          @error('picture')
          <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        

      <h3 class="card-title">
        {{-- <input name="constructionDate" type="number" placeholder="construction date"
              class="@error('constructionDate') is-invalid @enderror"> --}}
        <select name="constructionDate" class="@error('constructionDate') is-invalid @enderror">
          <option value="">Year</option>
          <option value="1919">1919</option>
          <option value="1920">1920</option>
          <option value="1921">1921</option>
          <option value="1922">1922</option>
          <option value="1923">1923</option>
          <option value="1924">1924</option>
          <option value="1925">1925</option>
          <option value="1926">1926</option>
          <option value="1927">1927</option>
          <option value="1928">1928</option>
          <option value="1929">1929</option>
          <option value="1930">1930</option>
          <option value="1931">1931</option>
          <option value="1932">1932</option>
          <option value="1933">1933</option>
          <option value="1934">1934</option>
          <option value="1935">1935</option>
          <option value="1936">1936</option>
          <option value="1937">1937</option>
          <option value="1938">1938</option>
          <option value="1939">1939</option>
          <option value="1940">1940</option>
          <option value="1941">1941</option>
          <option value="1942">1942</option>
          <option value="1943">1943</option>
          <option value="1944">1944</option>
          <option value="1945">1945</option>
          <option value="1946">1946</option>
          <option value="1947">1947</option>
          <option value="1948">1948</option>
          <option value="1949">1949</option>
          <option value="1950">1950</option>
          <option value="1951">1951</option>
          <option value="1952">1952</option>
          <option value="1953">1953</option>
          <option value="1954">1954</option>
          <option value="1955">1955</option>
          <option value="1956">1956</option>
          <option value="1957">1957</option>
          <option value="1958">1958</option>
          <option value="1959">1959</option>
          <option value="1960">1960</option>
          <option value="1961">1961</option>
          <option value="1962">1962</option>
          <option value="1963">1963</option>
          <option value="1964">1964</option>
          <option value="1965">1965</option>
          <option value="1966">1966</option>
          <option value="1967">1967</option>
          <option value="1968">1968</option>
          <option value="1969">1969</option>
          <option value="1970">1970</option>
          <option value="1971">1971</option>
          <option value="1972">1972</option>
          <option value="1973">1973</option>
          <option value="1974">1974</option>
          <option value="1975">1975</option>
          <option value="1976">1976</option>
          <option value="1977">1977</option>
          <option value="1978">1978</option>
          <option value="1979">1979</option>
          <option value="1980">1980</option>
          <option value="1981">1981</option>
          <option value="1982">1982</option>
          <option value="1983">1983</option>
          <option value="1984">1984</option>
          <option value="1985">1985</option>
          <option value="1986">1986</option>
          <option value="1987">1987</option>
          <option value="1988">1988</option>
          <option value="1989">1989</option>
          <option value="1990">1990</option>
          <option value="1991">1991</option>
          <option value="1992">1992</option>
          <option value="1993">1993</option>
          <option value="1994">1994</option>
          <option value="1995">1995</option>
          <option value="1996">1996</option>
          <option value="1997">1997</option>
          <option value="1998">1998</option>
          <option value="1999">1999</option>
          <option value="2000">2000</option>
          <option value="2001">2001</option>
          <option value="2002">2002</option>
          <option value="2003">2003</option>
          <option value="2004">2004</option>
          <option value="2005">2005</option>
          <option value="2006">2006</option>
          <option value="2007">2007</option>
          <option value="2008">2008</option>
          <option value="2009">2009</option>
          <option value="2010">2010</option>
        </select><span class="normalLabels">Year of construction</span>
        @error('constructionDate')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </h3>

      <h3 class="card-title"><input name="brand" type="text" placeholder="Brand" class="@error('brand') is-invalid @enderror"><span class="normalLabels">Brand</span>
        @error('brand')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </h3>

      <h3 class="card-title"><input name="model" type="text" placeholder="Model" class="@error('model') is-invalid @enderror"><span class="normalLabels">Model</span>
        @error('model')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </h3>

      <h3 class="card-title"><input name="color" type="text" placeholder="Color" class="@error('color') is-invalid @enderror"><span class="normalLabels">Color</span>
        @error('color')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </h3>


      <h3 class="card-title"><input name="price" type="text" placeholder="Price" step="0.5" class="@error('price') is-invalid @enderror"><span class="normalLabels">Price</span>
        @error('price')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
      </h3>
      <span class="normalLabels">Description:</span>
      <textarea style=" font-size: 200%;padding: 30px; font-family: 'Times New Roman',
          Times, serif; font-style: italic; " name="description" id="" cols="30" rows="5" class="form-control z-depth-1 @error('description') is-invalid @enderror" placeholder="Description"></textarea><br>
      @error('description')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
      @enderror

      <span class="normalLabels">Thumbnail picture:</span>
      <div class="custom-file" style="margin: 10px 0;">
        <input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
        <input id="thumbFile" value="browse" type="file" class="custom-file-input @error('thumbnail') is-invalid @enderror" name=" thumbnail" placeholder="Upload thumbnail..."><br>
        @error('thumbnail')
        <span class="invalid-feedback" role="alert">
          <strong>{{ $message }}</strong>
        </span>
        @enderror
        <label class="custom-file-label" for="thumbFile">Choose thumbnail</label>
      </div>


      <div style="display: flex; justify-content: space-around;">

        <input class="btn btn-success btn-lg" type="submit" name="submit" value="Save">
        <a href="/motors"><input class="btn btn-success btn-lg" type="button" value="Back"></a>
      </div>

      </form>
    </div>
  </div>
</div>
</div>
<script>
  // Add the following code if you want the name of the file appear on select
  $(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
  });
</script>

@endsection



@section('footer')
<footer class="footer">
  <br>
  <div style="display: flex; justify-content: center; color: white">© 2018 Copyright:</div>
</footer>
@endsection