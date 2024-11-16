
<form method="get">
    <fieldset>
        <legend>Creer un utilisateur :</legend>

        <input type="hidden" name="action" value="creerDepuisFormulaire">

        <p class="InputAddOn">
            <label class="InputAddOn-item" for="login_id">Login&#42;</label>
            <input class="InputAddOn-field" type="text" placeholder="Ex : leblancj" name="login" id="login_id" required>
        </p>

        <p class="InputAddOn">
            <label class="InputAddOn-item" for="prenom_id">Prenom</label> :
            <input class="InputAddOn-field" type="text" placeholder="juste" name="prenom" id="prenom_id" required/>
        </p>

        <p>
            <label class="InputAddOn-item" for="nom_id">Nom</label> :
            <input class="InputAddOn-field" type="text" placeholder="leblanc" name="nom" id="nom_id" required/>
        </p>

        <p>
            <input type="submit" value="Envoyer" />
        </p>
    </fieldset>
</form>

