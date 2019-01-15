package com.example.rr17d2.foodtruck;

import android.annotation.SuppressLint;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import java.io.UnsupportedEncodingException;
import java.net.URLEncoder;

import static android.widget.Toast.LENGTH_SHORT;

public class TruckDetailActivity extends AppCompatActivity {
    String from;
    String truckName;
    private EditText truckNameEditText;
    private EditText tagLineEditText;
    private EditText street1EditText;
    private EditText street2EditText;
    private Button updateDetailsButton;
    private int truckId;
    @SuppressLint("WrongViewCast")
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_truck_detail);
        truckNameEditText = findViewById(R.id.truckText);
        tagLineEditText = findViewById(R.id.TruckText2);
        street1EditText = findViewById(R.id.TruckText3);
        street2EditText = findViewById(R.id.TruckText4);
        updateDetailsButton = findViewById(R.id.Truckbutton);
    }
    @Override
    protected void onResume() {
        super.onResume();
        from = getIntent().getStringExtra("from");
        truckName = getIntent().getStringExtra("truck");
        Log.d("search for this truck",truckName);
        loadTruckDetails();
        setEnabled("update".equals(from));
    }

    public void setUpdateDetailsButton(View view) {
        Log.d("click", "Update was called");
        String url = null;

        try {
            url = getString(R.string.baseUrl) + "/truckUpdate.php?id=" +
                    URLEncoder.encode(String.valueOf(truckId), "UTF-8") + "&name=" +
                    URLEncoder.encode(String.valueOf(truckNameEditText.getText()), "UTF-8") + "&tag=" +
                    URLEncoder.encode(String.valueOf(tagLineEditText.getText()), "UTF-8") + "&street1=" +
                    URLEncoder.encode(String.valueOf(street1EditText.getText()), "UTF-8") + "&street2=" +
                    URLEncoder.encode(String.valueOf(street2EditText.getText()), "UTF-8");
        } catch (Exception ex) {
            Log.d("Error", ex.getMessage());
        }
        Log.d("URL", url);
        RequestQueue queue = Volley.newRequestQueue(this);
        StringRequest stringRequest = new StringRequest(Request.Method.GET, url,
                (response) -> {
                    Toast.makeText(getApplicationContext(), response, LENGTH_SHORT).show();
                }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Log.e("ERROR DESC Rest Call", error.getMessage());
            }
        });
        queue.add(stringRequest);
    }

    private void setEnabled(boolean enabled) {
        truckNameEditText.setEnabled(enabled);
        tagLineEditText.setEnabled(enabled);
        street1EditText.setEnabled(enabled);
        street2EditText.setEnabled(enabled);
        updateDetailsButton.setVisibility(enabled ? View.VISIBLE : View.INVISIBLE);
    }

    private void loadTruckDetails() {
        String url = null;
        try{
            url = getString(R.string.baseUrl) + "truckDesc.php?name=" + URLEncoder.encode(truckName, "UTF-8");
        } catch (UnsupportedEncodingException e){
            e.printStackTrace();
        }
        RequestQueue queue = Volley.newRequestQueue(this);
        StringRequest stringRequest = new StringRequest(Request.Method.GET, url,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        placeDetail(response.split(","));
                    }
                }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Log.d("ERROR DESC Rest Call", error.getMessage());
            }
        });
        queue.add(stringRequest);
    }

    private void placeDetail(String[] details) {
        truckId = Integer.parseInt(details[0]);
        truckNameEditText.setText(details[1]);
        tagLineEditText.setText(details[2]);
        street1EditText.setText(details[3]);
        street2EditText.setText(details[4]);

    }
}
