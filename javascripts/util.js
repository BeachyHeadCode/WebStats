function log(msg) {
	console.log('[Potions] ' + msg);
}

function logInfo(msg) {
	console.info('[Potions] ' + msg);
}

function logWarning(msg) {
	console.warn('[Potions] ' + msg);
}

function logDebug(msg) {
	console.debug('[Potions] ' + msg);
}

function logError(msg) {
	console.error('[Potions] ' + msg);
}

function getValue(file, value) {
	return $(file).find(value).text();
}