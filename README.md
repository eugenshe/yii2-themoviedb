# yii2-themoviedb
themoviedb API extension wrapper

<b>Usage</b> <br/>
in main.php<br/>
```
// application components
	'components'=> [
		...
		'mdbApi' => [
           'class' => 'application.extensions.mdbApi.MdbApiComponent'
		],
		...
	]	
```
<code>Yii::$app->mdbApi->setApiKey('Your api key here')->startGuestSession();</code>


<b>Discover movies</b> </br>
<code>$type = DiscoverRequest::DISCOVER_POPULAR;</code> <br/>
<code>$data = Yii::$app->mdbApi->discoverMovies($type);</code>

<b>Movie details</b> </br>
<code>$data = Yii::$app->mdbApi->movieDetails('Movie ID');</code>

<b>Rate movies</b> </br>
<code>Yii::$app->mdbApi->rateMovie('Movie ID', 'Your rating');</code>


