<script type="text/template" data-grid="transaction" data-template="results">

	<% _.each(results, function(r) { %>

		<tr data-grid-row>
			<td><input content="id" input data-grid-checkbox="" name="entries[]" type="checkbox" value="<%= r.id %>"></td>
			<td><a href="<%= r.edit_uri %>" href="<%= r.edit_uri %>"><%= r.id %></a></td>
			<td><%= r.Company %></td>
			<td><%= r.Calendar %></td>
			<td><%= r.Amount %></td>
			<td><%= r.Type %></td>
			<td><%= r.Paid_By %></td>
			<td><%= r.created_at %></td>
		</tr>

	<% }); %>

</script>
