package idv.PN_Wu;

import java.io.IOException;
import java.net.URI;
import java.net.URISyntaxException;

import org.apache.http.HttpResponse;
import org.apache.http.HttpStatus;
import org.apache.http.client.ClientProtocolException;
import org.apache.http.client.HttpClient;
import org.apache.http.client.methods.HttpGet;
import org.apache.http.impl.client.DefaultHttpClient;
import org.apache.http.util.EntityUtils;

import android.util.Log;

public class Http {
	private static final String strServerURL = "http://liblibrary-reposchool.rhcloud.com";

	public static String getBookInformation(String isbn) {
		String strResponse = null;

		URI uri;
		try {
			uri = new URI(String.format("%s/%s?%s=%s", strServerURL,
					"book_info.json", "isbn", isbn));
			HttpGet request = new HttpGet(uri);
			HttpClient client = new DefaultHttpClient();
			HttpResponse response;
			response = client.execute(request);
			if (response.getStatusLine().getStatusCode() != HttpStatus.SC_OK) {
				strResponse = response.getStatusLine().toString();
				Log.e("PN Wu: Http Error", strResponse);
			}
			strResponse = EntityUtils.toString(response.getEntity());
			// strResponse = new String(strResponse.getBytes("Big5"), "UTF-8");
		} catch (URISyntaxException e1) {
			// TODO Auto-generated catch block
			e1.printStackTrace();
		} catch (ClientProtocolException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		} catch (IOException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}
		
		return strResponse;
	}
}
