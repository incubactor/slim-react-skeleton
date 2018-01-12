import React, {Component, PropTypes} from 'react';
import { connect } from 'react-redux';
import { withRouter } from 'react-router';
import authPropTypes from '../../store/propTypes/auth';
import {logout} from '../../store/actions/auth/thunks';

class Logout extends Component {

    constructor(props) {
    	super(props);
        this.props.onLogoutRequest(props.auth.user.id);
    }

    static propTypes = {
        auth: authPropTypes,
        onLogoutRequest: PropTypes.func.isRequired
    };

    componentWillReceiveProps(nextProps) {
    	if (nextProps.auth.isAuthenticated == false) {
            this.props.router.push('/');
        }
        
    }

    render() {

        return (
            <div>
                <h1>Logout</h1>
                Bye...
            </div>
        );
    }
}

const mapStateToProps = (state) => {
    return {
        auth: state.auth
    }
};

export default withRouter(connect(mapStateToProps, { onLogoutRequest: logout })(Logout));
