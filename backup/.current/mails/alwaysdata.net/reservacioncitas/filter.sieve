# Sieve filter

require ["fileinto", "relational", "comparator-i;ascii-numeric", "vacation", "vacation-seconds", "copy", "reject", "body"];


##
## Local storage
##

if allof (
    not header :contains ["X-alwaysdata-Spam-Score"] "-"
)
{
    # Spam to delete
    if header :value "ge" :comparator "i;ascii-numeric" ["X-alwaysdata-Spam-Score"] ["15"]
    {
        discard;
        stop;
    }

    # Spam to store
    elsif header :value "ge" :comparator "i;ascii-numeric" ["X-alwaysdata-Spam-Score"] ["5"]
    {
        fileinto "Spam";
        stop;
    }
}
