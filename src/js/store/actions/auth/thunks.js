/**
 * Created by geraud on 29/07/2016.
 */

import * as authActions from './actions';
import axios from '../../../lib/api';

export function logout(userId) {

    return (dispatch) => {

    	dispatch(authActions.logoutRequest(userId));

        return axios({
            url: 'auth/' + userId,
            method: 'delete'
        })
        .then(function (response) {
            dispatch(authActions.logoutSuccess())
        })
        .catch(function (error) {
            dispatch(authActions.logoutFail('Sorry, try later...'));
        })
    }
}

/**
 * Send token request. response : { success: boolean, token: string, user:
 * object, message: string }
 * 
 * @param credential
 * @param password
 * @returns {function()}
 */
export function login(credential, password) {

    return (dispatch) => {

        if (credential && password) {

            dispatch(authActions.loginRequest(credential, password));

            return axios({
                url: 'auth',
                method: 'post',
                data: {
                    credential: credential,
                    password: password
                },
            })
            .then(function (response) {
                response.data.success
                    ? dispatch(authActions.loginSuccess(response.data.token, response.data.user))
                    : dispatch(authActions.loginFail(response.data.message));
            })
            .catch(function (error) {
                dispatch(authActions.loginFail('Sorry, try later...'));
            })
        }
    }
}


export function register(registrationData) {

    return (dispatch) => {

        dispatch(authActions.registrationRequest(registrationData));

        return axios({
            url: 'users',
            method: 'post',
            data: {...registrationData},
        })
        .then(function (response) {
            if (response.data.success) {
        		dispatch(authActions.registrationSuccess(response.data.user));
        		dispatch(authActions.loginSuccess(response.data.token, response.data.user));
            } else {
            	dispatch(authActions.registrationFail(response.data.message));
            }
        })
        .catch(function (error) {
            dispatch(authActions.loginFail('Sorry, try later...'));
        })
    }
}


/**
 * Send token request. response : { success: boolean, token: string, user:
 * object, message: string }
 * 
 * @param money
 * @returns {function()}
 */
export function calculateItem(money, itemId) {
    return (dispatch, getState) => {
        if (money) {

            dispatch(authActions.itemRequest(money, itemId));
            return axios({
                url: 'items',
                method: 'post',
                headers: {'Authorization': `Bearer ${getState().auth.token}`},
                data: {
                    money: money,
                    itemId: itemId
                },
            })
            .then(function (response) {
                console.log(response);
                response.data.success
                    ? dispatch(authActions.itemSuccess(response.data))
                    : dispatch(authActions.itemFail(response.data.message));
            })
            .catch(function (error) {
                dispatch(authActions.itemFail('Sorry, try later...'));
            })
        }
    }
}
