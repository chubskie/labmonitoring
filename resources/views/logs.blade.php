@extends('_layout')

@section('_styles')
<link rel="stylesheet" href="{{ asset('css/bulma-divider.min.css') }}">
@endsection

@section('body')

<!-- <div class="container is-fluid"> -->
<div class="level">
	<div class="level-left">
		<div class="level-item">
    <span class="icon">
					<i class="fas fa-stream"></i>
				</span>
			<h3 class="title">Logs</h3>
		</div>
	</div>
	<div class="level-right">
		<div class="level-item">
			<a href="/">
                <button id="add" class="button is-link">
				<span class="icon">
					<i class="fas fa-undo"></i>
				</span>
				<span>Return</span>
			    </button>
            </a>
		</div>
	</div>
</div>
<hr>
<div class="field is-horizontal">
  <div class="field-label is-normal">
    <label class="label">Search</label>
  </div>
    <div class="field">
        <input class="input" type="email" placeholder="">
      </p>
    </div>
</div>
<table class="table is-hoverable is-bordered is-fullwidth">
  <thead>
    <tr>
      <th>LogID</th>
      <th>Name</th>
      <th>Laboratory</th>
      <th>Activity</th>
      <th>Timestamp</th>
      <!-- <th><abbr title="Points">Pts</abbr></th> -->
    </tr>
  </thead>
  <tfoot>
    <tr>
    </tr>
  </tfoot>
  <tbody>
    <tr>
      <th>1</th>
      <td><a href="https://en.wikipedia.org/wiki/Leicester_City_F.C." title="Leicester City F.C.">Leicester City</a> <strong>(C)</strong>
      </td>
      <td>38</td>
      <td>23</td>
      <td>12</td>

    </tr>
    <tr>
      <th>2</th>
      <td><a href="https://en.wikipedia.org/wiki/Arsenal_F.C." title="Arsenal F.C.">Arsenal</a></td>
      <td>38</td>
      <td>20</td>
      <td>11</td>
    </tr>
    <tr>
      <th>3</th>
      <td><a href="https://en.wikipedia.org/wiki/Tottenham_Hotspur_F.C." title="Tottenham Hotspur F.C.">Tottenham Hotspur</a></td>
      <td>38</td>
      <td>19</td>
      <td>13</td>
    </tr>
    <tr class="is-selected">
      <th>4</th>
      <td><a href="https://en.wikipedia.org/wiki/Manchester_City_F.C." title="Manchester City F.C.">Manchester City</a></td>
      <td>38</td>
      <td>19</td>
      <td>9</td>
    </tr>
    <tr>
      <th>5</th>
      <td><a href="https://en.wikipedia.org/wiki/Manchester_United_F.C." title="Manchester United F.C.">Manchester United</a></td>
      <td>38</td>
      <td>19</td>
      <td>9</td>
    </tr>
    <tr>
      <th>6</th>
      <td><a href="https://en.wikipedia.org/wiki/Southampton_F.C." title="Southampton F.C.">Southampton</a></td>
      <td>38</td>
      <td>18</td>
      <td>9</td>
    </tr>
    <tr>
      <th>7</th>
      <td><a href="https://en.wikipedia.org/wiki/West_Ham_United_F.C." title="West Ham United F.C.">West Ham United</a></td>
      <td>38</td>
      <td>16</td>
      <td>14</td>
    </tr>
  </tbody>
</table>

<!-- <a href="/" class="button is-success">Return</a> -->
<!-- </div> -->
@endsection

@section('scripts')
@endsection