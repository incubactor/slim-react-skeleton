/**
 * Created by geraud on 26/07/2016.
 */

import * as authActionTypes from '../actions/auth/types'

const initialState = {
	    isAuthenticated: false,
	    user: {},
	    token: '',
	    errors: []
}

export default function auth(state = {isAuthenticated: false, user: {}, token: '', errors: []}, action) {

    switch (action.type) {

        case authActionTypes.LOGIN_REQUEST:
            return Object.assign({}, state, initialState);

        case authActionTypes.LOGIN_SUCCESS:
            return Object.assign({}, state, {
                isAuthenticated: true,
                user: action.user,
                token: action.token,
                errors: []
            });

        case authActionTypes.LOGIN_FAILURE:
            return Object.assign({}, state, {
                isAuthenticated: false,
                user: {},
                token:'',
                errors: [action.message]
            });

        case authActionTypes.LOGOUT_SUCCESS:
            return Object.assign({}, state, initialState);
        case authActionTypes.ITEM_SUCCESS:
            //console.log("THIS IS WHERE I SHOULD DO SOMETHING");
            //console.log("ITEM_SUCcess");
            //console.log(action);
            console.log(state);
            return Object.assign({}, state, {
                items: action.items.items
            });
        case authActionTypes.ITEM_FAILURE:
        	console.log("OK SO HERE")
            return Object.assign({}, state, initialState);

        default:
            return state
    }
}
/*

const initialState = {
    isAuthenticated: false,
    user: {},
    token: '',
    errors: []
}

const reducer = (state, action) => {

    switch (action.type) {

        case authActionTypes.LOGIN_REQUEST:
            return Object.assign({}, state, {
                isAuthenticated: false,
                errors: []
            });

        case authActionTypes.LOGIN_SUCCESS:
            return Object.assign({}, state, {
                isAuthenticated: true,
                user: action.user,
                token: action.token,
                errors: []
            });

        case authActionTypes.LOGIN_FAILURE:
            return Object.assign({}, state, {
                isAuthenticated: false,
                user: {},
                token:'',
                errors: [action.message]
            });

        case authActionTypes.LOGOUT_SUCCESS:
            return Object.assign({}, state, {
                isAuthenticated: false,
                errors: [],
                token:'',
                user: {}
            });
        case authActionTypes.ITEM_SUCCESS:
            console.log("THIS IS WHERE I SHOULD DO SOMETHING");
            console.log("ITEM_SUCcess");
            //console.log(action);
            console.log(state);
            return Object.assign({}, state, {
                items: action.items.items
            });
        default:
            return initialState
    }
}
export default reducer;

*/