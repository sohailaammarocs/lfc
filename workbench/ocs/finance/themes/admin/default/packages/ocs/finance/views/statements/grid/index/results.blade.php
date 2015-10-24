<script type="text/template" data-grid="statement" data-template="results">

	<% _.each(results, function(r) { %>

		<tr data-grid-row>
			<td><input content="id" input data-grid-checkbox="" name="entries[]" type="checkbox" value="<%= r.id %>"></td>
			<td><a href="<%= r.edit_uri %>" href="<%= r.edit_uri %>"><%= r.id %></a></td>
			<td><%= r.Date %></td>
			<td><%= r.Description %></td>
			<td><%= r.Money_in %></td>
			<td><%= r.Money_out %></td>
			<td><%= r.Balance %></td>
			<td><%= r.created_at %></td>
		</tr>

	<% }); %>

</script>
