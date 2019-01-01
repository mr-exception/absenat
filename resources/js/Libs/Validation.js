const required = (value) => {
    if(!value) return false;
    if(value.length == 0) return false;
    return true;
}

const email = (value) => {
    let regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
    return regex.test(value);
}

const equal = (value, target) => {
    return value == target;
}

const min = (value, rule) => {
    const size = rule.split(':')[1];
    return value.length >= size;
}

const max = (value, rule) => {
    const size = rule.split(':')[1];
    return value.length <= size;
}

const validate = (rules, value) => {
    const rules_array = rules.split('|');
    let result = true;
    for(let i=0; i<rules_array.length; i++){
        if(rules_array[i].startsWith('required'))
            result = result && required(value);
        if(rules_array[i].startsWith('email'))
            result = result && email(value);
        if(rules_array[i].startsWith('equal'))
            result = result && equal(value);
        if(rules_array[i].startsWith('min'))
            result = result && min(value, rules_array[i]);
        if(rules_array[i].startsWith('max'))
            result = result && max(value, rules_array[i]);
        if(!result)
            return 'error';
    }
    return 'success';
}

module.exports = {
    'validate': validate,
}