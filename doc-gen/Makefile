VALA_VERSION = $(shell vala --version | awk -F. '{ print "0."$$2 }')

generate-json: update-girs libdoclet.so
	$(RM) -r docs
	G_MESSAGES_DEBUG=all valadoc \
		-o docs \
		--girdir girs/gir-1.0/ \
		--vapidir girs/vala/vapi/ \
		--doclet . \
		--driver $(VALA_VERSION) \
		--deps

libdoclet.so: JsonDoclet.vala
	valac -C --pkg valadoc-1.0 --pkg libxml-2.0 JsonDoclet.vala
	gcc -shared -fPIC -o libdoclet.so JsonDoclet.c $(shell pkg-config --cflags --libs valadoc-1.0 libxml-2.0)
	rm JsonDoclet.c

update-girs:
	[ -d girs ] && git -C girs pull || git clone https://github.com/nemequ/vala-girs.git girs

generate-all: update-girs libdoclet.so
	$(RM) -r docs
	for pkg in $(shell find /usr/share/vala-$(VALA_VERSION)/vapi -name '*.vapi' | cut -d '/' -f 6 | sed 's/\.vapi//'); do \
		echo $$pkg; \
		G_MESSAGES_DEBUG=all valadoc \
			-o docs/$$pkg \
			--pkg $$pkg \
			--girdir girs/gir-1.0/ \
			--vapidir girs/vala/vapi/ \
			--doclet . \
			--driver $(VALA_VERSION) \
			--deps; \
	done
