var options = {
    "key": keyId,
    "subscription_id": subscriptionId,
    "subscription_card_change": 0,
    "name": planName,
    "description": planDescription,
    "image": APP_URL+"/images/logo1.png",
    "handler": function(response) {
      window.location.href=APP_URL+"/transaction/"+response.razorpay_payment_id+"/"+response.razorpay_subscription_id+"/"+response.razorpay_signature+"/"+type;
    },
    "prefill": {
      "name": name,
      "email": email
    },  
    "theme": {
      "color": "#9d548b"
    },
  };
var rzp1 = new Razorpay(options);
document.getElementById('rzp-button1').onclick = function(e) {
  rzp1.open();
  e.preventDefault();
}