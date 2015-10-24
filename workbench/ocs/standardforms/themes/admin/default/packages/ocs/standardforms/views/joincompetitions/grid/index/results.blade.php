<script type="text/template" data-grid="joincompetition" data-template="results">

	<% _.each(results, function(r) { %>

		<tr data-grid-row>
			<td><input content="id" input data-grid-checkbox="" name="entries[]" type="checkbox" value="<%= r.id %>"></td>
			<td><a href="<%= r.edit_uri %>" href="<%= r.edit_uri %>"><%= r.id %></a></td>
			<td><%= r.team_name %></td>
			<td><%= r.team_type %></td>
			<td><%= r.competition_type %></td>
			<td><%= r.message_box %></td>
			<td><%= r.created_at %></td>
		</tr>

	<% }); %>

</script>
