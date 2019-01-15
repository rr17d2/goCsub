package com.example.rr17d2.foodtruck;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.EditText;
import android.widget.ListAdapter;
import android.widget.ListView;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

public class SearchActivity extends AppCompatActivity {
    String from;
    private EditText truckNameEditText;
    private ListView truckListView;
    private final String Base_URL = "https://www.cs.csub.edu/~jason/api/trucks.php?name=";
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_search);
        truckNameEditText = findViewById(R.id.truckNameEditText);
        truckListView = findViewById(R.id.ListviewTruck);
        //onSearchClick(truckListView);
        truckListView.setOnItemClickListener(new AdapterView.OnItemClickListener(){
            @Override
            public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                String truckClicked = String.valueOf(parent.getItemAtPosition(position));
                Log.d("truck name", truckClicked);
                Intent intent = new Intent(SearchActivity.this, TruckDetailActivity.class);
                intent.putExtra("from", from);
                intent.putExtra("truck", truckClicked);
                startActivity(intent);
            }
        });
    }

    /**
     * When you click search
     * @param view the view you click
     */
    public void onSearchClick(View view){
        String restURL = Base_URL + truckNameEditText.getText().toString();
        Log.d("clicked", restURL);
        RequestQueue queue = Volley.newRequestQueue(this);
        StringRequest stringRequest = new StringRequest(Request.Method.GET,
                restURL, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                Log.d("response from rest", response);
                insertData(response.split("<br>"));
            }
        }, new Response.ErrorListener(){

            @Override
            public void onErrorResponse(VolleyError error){
                Log.d("Error from rest", error.getMessage());
            }
        }
        );
        queue.add(stringRequest);
    }

    @Override
    protected void onResume() {
        super.onResume();
        from = getIntent().getStringExtra("from");
        Log.d("From", from);
    }

    private void insertData(String[] trucks) {
        ListAdapter truckList = new ArrayAdapter<>(this,
                R.layout.support_simple_spinner_dropdown_item,trucks);
        truckListView.setAdapter(truckList);
    }
    }
