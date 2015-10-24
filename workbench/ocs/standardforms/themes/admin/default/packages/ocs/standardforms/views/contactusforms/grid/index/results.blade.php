<script type="text/template" data-grid="contactusform" data-template="results">

	<% _.each(results, function(r) { %>

		<tr data-grid-row>
			<td><input content="id" input data-grid-checkbox="" name="entries[]" type="checkbox" value="<%= r.id %>"></td>
			<td><a href="<%= r.edit_uri %>" href="<%= r.edit_uri %>"><%= r.id %></a></td>
			<td><%= r.first_name %></td>
			<td><%= r.last_name %></td>
			<td><%= r.gender %></td>
			<td><%= r.work_phone %></td>
			<td><%= r.mobile %></td>
			<td><%= r.created_at %></td>
		</tr>

	<% }); %>

</script>
