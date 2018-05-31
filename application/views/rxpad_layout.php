<div id="rx-pad" style="/*width: 7.5in !important;*/
    height: 11in !important;
    /*margin: 10px auto;*/
    page-break-after: always;
    position: relative;
    font-size: 20px;
    background-color: #fff;
    color: #000;">
	<div id="rx-header" style="margin-top: 165px;position: absolute;width: 100%; /*padding: 0px 30px;*/font-size: 22px;">
		<table width="100%">
			<tbody>
				<tr>
					<td><strong  style="font-size: 23px;">Name :</strong></td>
					<td>
					<strong  style="font-size: 23px;">{{patient_name}}</strong>
					</td>
					<td>Date:</td>
					<td>{{consultation_date}}</td>
				</tr>
				<tr>
					<td>Age :</td>
					<td>{{patient_age}}</td>
					<td>Gender :</td>
					<td>{{patient_gender}}</td>
				</tr>
				<tr>
					<td>Address :</td>
					<td colspan="3">
						{{patient_address}}
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div id="rx-body" style="min-height: 570px;
    font-weight: bold;
    color: rgb(51, 122, 183);
    position: absolute;
    top: 360px;
    width: 100%;
    font-size: 23px;">
		{{prescriptions}}
	</div>
	<div id="rx-footer" style="position: absolute;bottom: 75px;width: 100%;font-size: 20px;">
		<table width="100%">
			<tbody>
				<tr>
					<td align="right" colspan="2">
						<span style="font-size: 22px;"><strong style="font-size: 23px;">{{business_owner}}</strong></span>
					</td>
				</tr>
				<tr>
					<td style="vertical-align: top;">
						Patient ID : <strong  style="font-size: 23px;">{{patient_id}}</strong><br>
						<span style="font-size: 12px;">Use this ID Number on next visit.</span>
					</td>
					<td align="right">
						<ul id="serials" style="list-style: none;">
							<li>License No : {{prc}}</li>
							<li>PTR No : {{ptr}}</li>
							<li>S2 No : {{s2}}</li>
						</ul>
					</td>
				</tr>
				
			</tbody>
		</table>
	</div>
</div>