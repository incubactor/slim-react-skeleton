/**
 * Created by geraud on 30/07/2016.
 */

import React, {Component, PropTypes} from 'react';

const FormError = ({errors}) => (
		errors ?  
		  <div>
		    {errors.map((error, index) => (
		      <div className="error" key={index}>{error}</div>
		    ))}
		  </div>
		: <div></div>
		); 

FormError.propTypes = {message: React.PropTypes.string};

export default FormError;