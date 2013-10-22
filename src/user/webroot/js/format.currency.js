(function(jq){
	jq.fn.numberFormat = function(number, prefix, options){
		
		var settings = jq.extend({
					periodSign		: "."
				,	thousandSign	: "'"
				,	fractional		: 0
				}, options ),
			parts = ('' + number).trim().split('.'),
			from = parts[0],
			to = '',
			length = from.length,
			prefix = prefix.length > 0 ? prefix + ' ' : '',
			frac = settings.fractional > 0 && parts[1].length > 0
				? settings.periodSign + parts[1].substr(0, settings.fractional)
				: '';
		
		for (var i in from) {
			to += (length-- % 3 ? '' : settings.thousandSign) + from[i];
		}
		
		this.text(prefix + to + frac);
		
		return this;
	}
})(jQuery);