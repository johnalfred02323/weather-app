<h1>Weather Application</h1>

<h2>Prerequisites:</h2>
<ul>
<li>Laravel 11</li>
<li>Vue 3</li>
<li>Inertia JS</li>
<li>Tailwind</li>
</ul>

<h2>APIs:</h2>
<ul>
<li>Foursquare API</li>
<li>Geoapify API</li>
<li>Openweather API</li>
</ul>


<p>
When designing the UI/UX, I prioritized the user needs and simplicity, following such clarity is just one look. I used the Laravel with Vue JS to implement the Single Page Application in this project.
I implemented a two way to use the application, first I prioritize the Foursquare API and added the Geoapify API to serve as a backup if ever the first API did not work. I implemented this just to make sure that the application is usable.
</p>
<p>
For the user interface, I include the details of the city that the user searched on. Aside from this, I separate all the forecast that the Openweather API  returns, so that the user can differentiate the Date and Time between forecasts. I added the forcasted weater alongside the other information like the temperature (current, minimum and maximum), real feel, humidity, wind, pressure and also a information about the rain in the last 3 hours so that the user will have the details in the forecast.
</p>