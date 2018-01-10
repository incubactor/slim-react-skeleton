import React, { Component } from 'react';
import {Link} from 'react-router';

export default class Home extends Component {
    render() {
        return (
            <div>
	            <h1>Home</h1>
	            <div>This is a hello world of a reactjs + php skeleton application. In order to access some of our pages, you need to be authenticated. </div>
	            <div>Please register, or make login if you already did so.</div>
	            <div>After being logged, you'll be able to go to our <Link to="/items">the Candies calculation page</Link> </div>
            </div>
        );
    }
}