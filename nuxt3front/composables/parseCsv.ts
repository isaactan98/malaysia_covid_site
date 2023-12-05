export const parseCsv = (csv: string): any => {
    const lines = csv.split(/\r?\n/);

    // Extract headers (first row)
    const headers = lines[0].split(',');

    // Initialize an array to store the parsed CSV data
    const parsedData = [];

    // Iterate through each line starting from the second row
    for (let i = 1; i < lines.length; i++) {
        const fields = lines[i].split(','); // Split the line by commas
        const rowData = {} as any;

        // Create an object with keys from the headers and values from the current row
        for (let j = 0; j < headers.length; j++) {
            rowData[headers[j]] = fields[j];
        }

        // Add the row object to the parsed data array
        parsedData.push(rowData);
    }

    return parsedData;
}