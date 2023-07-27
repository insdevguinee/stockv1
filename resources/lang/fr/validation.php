<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | such as the size rules. Feel free to tweak each of these messages.
    |
    */

    'accepted'             => ':attribute doit être accepté.',
    'active_url'           => ":attribute n'est pas une URL valide.",
    'after'                => ':attribute doit être une date postérieure au :date.',
    'after_or_equal'       => ':attribute doit être une date postérieure ou égale au :date.',
    'alpha'                => ':attribute doit seulement contenir des lettres.',
    'alpha_dash'           => ':attribute doit seulement contenir des lettres, des chiffres et des tirets.',
    'alpha_num'            => ':attribute doit seulement contenir des chiffres et des lettres.',
    'array'                => ':attribute doit être un tableau.',
    'before'               => ':attribute doit être une date antérieure au :date.',
    'before_or_equal'      => ':attribute doit être une date antérieure ou égale au :date.',
    'between'              => [
        'numeric' => ':attribute doit être comprise entre :min et :max.',
        'file'    => 'La taille du fichier de :attribute doit être comprise entre :min et :max kilo-octets.',
        'string'  => 'Le texte :attribute doit contenir entre :min et :max caractères.',
        'array'   => 'Le tableau :attribute doit contenir entre :min et :max éléments.',
    ],
    'boolean'              => ':attribute doit être vrai ou faux.',
    'confirmed'            => ':attribute ne correspond pas.',
    'date'                 => ":attribute n'est pas une date valide.",
    'date_format'          => ':attribute ne correspond pas au format :format.',
    'different'            => ':attribute et :other doivent être différents.',
    'digits'               => ':attribute doit contenir :digits chiffres.',
    'digits_between'       => ':attribute doit contenir entre :min et :max chiffres.',
    'dimensions'           => "La taille de l'image :attribute n'est pas conforme.",
    'distinct'             => ':attribute a une valeur dupliquée.',
    'email'                => ':attribute doit être une adresse e-mail valide.',
    'exists'               => ':attribute sélectionné est invalide.',
    'file'                 => ':attribute doit être un fichier.',
    'filled'               => ':attribute est obligatoire.',
    'image'                => ':attribute doit être une image.',
    'in'                   => ':attribute est invalide.',
    'in_array'             => ':attribute n\'existe pas dans :other.',
    'integer'              => ':attribute doit être un entier.',
    'ip'                   => ':attribute doit être une adresse IP valide.',
    'json'                 => ':attribute doit être un document JSON valide.',
    'max'                  => [
        'numeric' => ':attribute ne peut être supérieure à :max.',
        'file'    => 'La taille du fichier de :attribute ne peut pas dépasser :max kilo-octets.',
        'string'  => 'Le texte de :attribute ne peut contenir plus de :max caractères.',
        'array'   => 'Le tableau :attribute ne peut contenir plus de :max éléments.',
    ],
    'mimes'                => ':attribute doit être un fichier de type : :values.',
    'mimetypes'            => ':attribute doit être un fichier de type : :values.',
    'min'                  => [
        'numeric' => ':attribute doit être supérieure ou égale à :min.',
        'file'    => 'La taille du fichier de :attribute doit être supérieure à :min kilo-octets.',
        'string'  => 'Le :attribute doit contenir au moins :min caractères.',
        'array'   => 'Le tableau :attribute doit contenir au moins :min éléments.',
    ],
    'not_in'               => ":attribute sélectionné n'est pas valide.",
    'numeric'              => ':attribute doit contenir un nombre.',
    'present'              => ':attribute doit être présent.',
    'regex'                => 'Le format du champ :attribute est invalide.',
    'required'             => ':attribute est obligatoire.',
    'required_if'          => ':attribute est obligatoire quand la valeur de :other est :value.',
    'required_unless'      => ':attribute est obligatoire sauf si :other est :values.',
    'required_with'        => ':attribute est obligatoire quand :values est présent.',
    'required_with_all'    => ':attribute est obligatoire quand :values est présent.',
    'required_without'     => ":attribute est obligatoire quand :values n'est pas présent.",
    'required_without_all' => ":attribute est requis quand aucun de :values n'est présent.",
    'same'                 => 'Les champs :attribute et :other doivent être identiques.',
    'size'                 => [
        'numeric' => ':attribute doit être :size.',
        'file'    => 'La taille du fichier de :attribute doit être de :size kilo-octets.',
        'string'  => 'Le texte de :attribute doit contenir :size caractères.',
        'array'   => 'Le tableau :attribute doit contenir :size éléments.',
    ],
    'string'               => ':attribute doit être une chaîne de caractères.',
    'timezone'             => ':attribute doit être un fuseau horaire valide.',
    'unique'               => 'La valeur du champ :attribute est déjà utilisée.',
    'uploaded'             => "Le fichier du champ :attribute n'a pu être téléchargé.",
    'url'                  => "Le format de l'URL de :attribute n'est pas valide.",

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom'               => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes'           => [
        'name'                  => 'nom',
        'username'              => 'nom d\'utilisateur',
        'email'                 => 'adresse e-mail',
        'first_name'            => 'prénom',
        'last_name'             => 'nom',
        'password'              => 'mot de passe',
        'password_confirmation' => 'confirmation du mot de passe',
        'city'                  => 'ville',
        'country'               => 'pays',
        'address'               => 'adresse',
        'phone'                 => 'téléphone',
        'mobile'                => 'portable',
        'age'                   => 'âge',
        'sex'                   => 'sexe',
        'gender'                => 'genre',
        'day'                   => 'jour',
        'month'                 => 'mois',
        'year'                  => 'année',
        'hour'                  => 'heure',
        'minute'                => 'minute',
        'second'                => 'seconde',
        'title'                 => 'titre',
        'content'               => 'contenu',
        'description'           => 'description',
        'excerpt'               => 'extrait',
        'date'                  => 'date',
        'time'                  => 'heure',
        'available'             => 'disponible',
        'size'                  => 'taille',
    ],

];
