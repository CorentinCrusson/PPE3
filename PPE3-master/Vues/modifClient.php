<div class="centrePage">
<FORM action = 'index.php?vue=compte&action=modification' method = 'post'>
	<TABLE>
		<TR>
			<TD>
				Modification de mon Profil
			</TD>
			<TABLE>
		</TR>
		<TR>
				<TH> Modifier mon Nom </TH>
					<TD>
            <INPUT type ='text' name ='nomClient'/>
					</TD>
		</TR>
		<TR>
			<TH> Modifier mon Prénom</TH>
				<TD>
					<INPUT type ='text' name ='prenomClient'/>
				</TD>
		</TR>
		<TR>
			<TH> Modifier mon E-Mail</TH>
				<TD>
					<INPUT type ='text' name ='mailClient'/>
				</TD>
		</TR>
  	<TR>
			<TH> Modifier mon mot de passe</TH>
				<TD>
          <INPUT type ='password' name ='passwdClient'/>
				</TD>
      </TR>
			</TABLE>

		<TR>
			<TD colspan = '2' align = 'right'>
				<INPUT type="reset" value="Annuler"/>
				<INPUT type = 'submit' value = 'Valider'/>
			</TD>
		</TR>
	</TABLE>
</FORM>
</div>
