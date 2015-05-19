function log(msg) {
	console.log(msg);
}
function logInfo(msg) {
	console.info(msg);
}
function logWarning(msg) {
	console.warn(msg);
}
function logError(msg) {
	console.error(msg);
}
function getValue(file, value) {
	return $(file).find(value).text();
}