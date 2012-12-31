<section id="slideshow"> 
	<ul>
		<% loop Slides %> 
		<% if not Archived %>		
		<li>
			<img src="<% with Image %><% with PaddedImage(930,430) %>$URL<% end_with %><% end_with %>" alt="$Title.XML"/>
			<% if Title %>
				<p class="caption">$Title</p>
			<% end_if %>
		</li>
			<% end_if %>
		<% end_loop %> 
	</ul>
</section>