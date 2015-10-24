<script type="text/template" data-grid="bookreferees" data-template="results">

	<% _.each(results, function(r) { %>

		<tr data-grid-row>
			<td><input content="id" input data-grid-checkbox="" name="entries[]" type="checkbox" value="<%= r.id %>"></td>
			<td><a href="<%= r.edit_uri %>" href="<%= r.edit_uri %>"><%= r.id %></a></td>
			<td><%= r.team_name %></td>
			<td><%= r.team_type %></td>
			<td><%= r.opponent_first_name %></td>
			<td><%= r.opponent_last_name %></td>
			<td><%= r.opponent_work_phone %></td>
			<td><%= r.opponent_mobile %></td>
			<td><%= r.opponent_email_address %></td>
			<td><%= r.opponent_team_name %></td>
			<td><%= r.match_gender %></td>
			<td><%= r.referees %></td>
			<td><%= r.assistant_refrees %></td>
			<td><%= r.fixture %></td>
			<td><%= r.fixture_type %></td>
			<td><%= r.competition_name %></td>
			<td><%= r.match_duration %></td>
			<td><%= r.match_start %></td>
			<td><%= r.match_end %></td>
			<td><%= r.fixture_date %></td>
			<td><%= r.pitch_surface %></td>
			<td><%= r.venue %></td>
			<td><%= r.message %></td>
			<td><%= r.created_at %></td>
		</tr>

	<% }); %>

</script>
