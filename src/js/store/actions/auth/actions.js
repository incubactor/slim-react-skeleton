/*
 * action types
 */

import * as actionTypes from './types';


//------------------------------
// LOGIN
//------------------------------

export function loginFail(message) {
    return {
        type: actionTypes.LOGIN_FAILURE,
        errors: [message]
    }
}

export function loginSuccess(token, user) {
    return {
        type: actionTypes.LOGIN_SUCCESS,
        token: token,
        user: user,
        errors: []
    }
}

export function loginRequest(credential, password) {
    return {
        type: actionTypes.LOGIN_REQUEST,
        credential: credential,
        password: password,
        errors: []
    }
}

//------------------------------
// LOGOUT
//------------------------------

export function logoutRequest(userId) {
    return {
		type: actionTypes.LOGOUT_REQUEST,
		userId: userId,
		errors: []
    }
}

export function logoutFail(message) {
    return {
		type: actionTypes.LOGOUT_FAIL,
		errors: [message]
    }
}

export function logoutSuccess() {
    return {
        type: actionTypes.LOGOUT_SUCCESS
    }
}

//------------------------------
// ITEMS(Candies)
//------------------------------
export function itemRequest(money) {
    return {
        type: actionTypes.ITEM_REQUEST,
        money: money
    }
}

export function itemSuccess(items) {
    return {
        type: actionTypes.ITEM_SUCCESS,
        items: items
    }
}

export function itemFail(message) {
    return {
        type: actionTypes.ITEM_FAILURE,
        errors: [message]
    }
}



//------------------------------
// REGISTRATION
//------------------------------

export function registrationSuccess(user) {
    return {
        type: actionTypes.REGISTRATION_SUCCESS,
        user: user
    }
}

export function registrationRequest(registrationData) {
    return {
        type: actionTypes.REGISTRATION_REQUEST,
        registrationData: registrationData

    }
}

export function registrationFail(message) {
    return {
        type: actionTypes.REGISTRATION_FAILURE,
        errors: [message]
    }
}






