<% if $ResponsiveSlides %>
    <div class="ResponsiveSlideshow">
        <ul class="ResponsiveSlides">
        <% loop $ResponsiveSlides %>
            <% include ResponsiveSlide %>
        <% end_loop %>
        </ul>
    </div>
<% end_if %>