import React from 'react';
import ReactDOM from 'react-dom';

function User(props) {
    return (
        <div className="container mt-5">
            <div className="row justify-content-center">
                <div className="col-md-8">
                    <div className="card text-center">
                        <div className="card-header"><h2>React Component in Laravel</h2></div>

                        <div className="card-body">I'm {props.text} React component in Laravel app!</div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default User;

// DOM element
if (document.getElementById('user')) {
    ReactDOM.render(<div><User text="iman" /><User text="wadera" /></div>, document.getElementById('user'));
}