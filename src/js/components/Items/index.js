import React, {Component, PropTypes} from 'react';
import { connect } from 'react-redux';
import { withRouter } from 'react-router';

import {calculateItem} from '../../store/actions/auth/thunks';
import authPropTypes from "../../store/propTypes/auth";

class Items extends Component {

    constructor(props) {
        super(props);
        this._redirect = this._redirect.bind(this);
        this._onSubmit = this._onSubmit.bind(this);
        this._onChangeMoney = this._onChangeMoney.bind(this);

        this.state = {
            money: '',
            items: 0,
            itemId: 1, //the id=1 correspond to Candies, we can extend this by adding a combo with different items
            errorMessage: {
                global: ''
            }
        }

    }

    static propTypes = {
        auth: authPropTypes,
        onitemRequest: PropTypes.func.isRequired
    };

    componentWillReceiveProps(nextProps) {
        this._redirect(nextProps);
    }

    _redirect(props) {
    	this.state.items = props.auth.items
    }

    _onChangeMoney(event) {
        var newState = Object.assign({}, this.state);
        newState.money = event.target.value;
        this.setState(newState);
    }

    _onSubmit(e) {
        e.preventDefault();
        if (!this.state.hasError) {
            this.props.onitemRequest(this.state.money, this.state.itemId)
        }
    }

    render() {

        return (
            <div>
                <h1>Items</h1>
                <div className="pure-form">
                    <div>
                        <label htmlFor="Items">How many Candies will you eat having this money: </label>
                        <input name="money"
                               type="text"
                               id="money"
                               value={this.state.money}
                               onChange={this._onChangeMoney}/>
                    </div>
                    <div>Each Candy costs you 5. For every three empty packages you return, you get one for free. </div>
                    <div>Considering those two rules you could get at most <strong>{this.state.items}</strong> Candies</div>
                    <div>
                        <button className="pure-button pure-button-primary" onClick={this._onSubmit}>Calculate</button>
                    </div>
                </div>

            </div>
        );
    }

}

const mapStateToProps = (state) => {
    return {
        auth: state.auth
    }
};

export default withRouter(connect(mapStateToProps, {onitemRequest: calculateItem})(Items));
