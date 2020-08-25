<? php 
    $ features  =  array (
 
    'block / simplehtml: myaddinstance'  =>  array ( 
        'captype'  =>  'escrever' , 
        'contextlevel'  => CONTEXT_SYSTEM , 
        'archetypes'  =>  array ( 
            'user'  => CAP_ALLOW
         ) ,
 
        'clonepermissionsfrom'  =>  'moodle / my: manageblocks' 
    ) ,
 
    'block / simplehtml: addinstance'  =>  array ( 
        'riskbitmask'  => RISK_SPAM | RISK_XSS ,
 
        'captype'  =>  'escrever' , 
        'contextlevel'  => CONTEXT_BLOCK , 
        'archetypes'  =>  array ( 
            'editando professor'  => CAP_ALLOW , 
            'gerente'  => CAP_ALLOW
         ) ,
 
        'clonepermissionsfrom'  =>  'moodle / site: manageblocks' 
    ) , 
) ;